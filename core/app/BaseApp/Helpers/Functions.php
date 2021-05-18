<?php

declare(strict_types = 1);

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Tymon\JWTAuth\Facades\JWTAuth;

if (!function_exists('urlLang')) {
    function urlLang($url, $fromlang, $toLang)
    {
        $currentUrl = str_replace('/' . $fromlang . '/', '/' . $toLang . '/', strtolower($url));
        return $currentUrl;
    }
}

if (!function_exists('encodeRequest')) {
    function encodeRequest($request)
    {
        $array = [];
        foreach ($request as $k => $r) {
            if (is_array($r)) {
                $array[$k] = json_encode($r);
            } else {
                $array[$k] = $r;
            }
        }
        return $array;
    }
}

if (!function_exists('getDefaultLang')) {
    function getDefaultLang()
    {
        if (in_array(request()->segment(1), langs())) {
            return LaravelLocalization::setLocale(request()->segment(1));
        } else {
            if (request()->segment(1) == '') {
                LaravelLocalization::setLocale(lang());
                return LaravelLocalization::setLocale(lang());
            } else {
                return LaravelLocalization::setLocale();
            }
        }
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (!function_exists('langs')) {
    function langs()
    {
        $languages = (array_keys(config('laravellocalization.supportedLocales'))) ?: [];
        return $languages;
    }
}

if (!function_exists('randString')) {
    function randString($length = 5)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randstring;
    }
}

if (!function_exists('languages')) {
    function languages()
    {
        $languages = config('laravellocalization.supportedLocales');
        $langs = [];
        foreach ($languages as $key => $value) {
            $langs[$key] = $value['name'];
        }
        return $langs;
    }
}

if (!function_exists('transformValidation')) {
    function transformValidation($errors)
    {
        $temp = [];
        if ($errors) {
            foreach ($errors as $key => $value) {
                $temp[$key] = @$value[0];
            }
        }
        return $temp;
    }
}

if (!function_exists('image')) {
    function image($img, $type, $folder = 'uploads')
    {
        $src = app()->make("url")->to('/') . '/' . $folder . '/' . $type . '/' . $img;
        return $src;
    }
}

if (!function_exists('imageProfileApi')) {
    function imageProfileApi($img, $type = 'small')
    {
        $src = storage_path('app/public/uploads/' . $type . '/' . $img);
        if (!file_exists($src) || !$img) {
            $src = asset('img/avatar.png');
        } else {
            $src = asset('storage/uploads/' . $type . '/' . $img);
        }
        return $src;
    }
}

if (!function_exists('resourceMediaUrl')) {
    function resourceMediaUrl($path)
    {
        $src = storage_path('app/public/uploads/large/' . $path);
        if (!file_exists($src)) {
            $src = null;
        } else {
            $src = asset('storage/uploads/large/' . $path);
        }
        return $src;
    }
}
if (!function_exists('imageUrl')) {
    function imageUrl($img, $type, $folder = 'uploads')
    {
        $src = storage_path('app/public/' . $folder . '/' . $type . '/' . $img);
        if (!file_exists($src)) {
            $src = 'https://via.placeholder.com/500x500';
        } else {
            $src = asset('storage/' . $folder . '/' . $type . '/' . $img);
        }
        return $src;
    }
}

if (!function_exists('viewImage')) {
    function viewImage($img, $type, $folder = 'uploads', $attributes = null)
    {
        if (!$folder) {
            $folder = 'uploads';
        }
        $width = 200;
        if ($attributes) {
            $width = @$attributes['width'];
            $class = @$attributes['class'];
            $id = @$attributes['id'];
        }
        $src = 'storage/' . $folder . '/' . $type . '/' . $img;
        if (!file_exists($src) || !$img) {
            $src = 'https://via.placeholder.com/500x500';
        } else {
            $src = app()->make("url")->to('/') . '/' . $src;
        }
        return '<img  width="' . $width . '" src="' . $src . '" class="' . @$class . '" id="' . @$id . '" >';
    }
}
if (!function_exists('viewInputImage')) {
    function viewInputImage($img, $type, $folder = 'uploads', $attributes = null)
    {
        if (!$folder) {
            $folder = 'uploads';
        }
        $width = 150;
        if ($attributes) {
            $width = @$attributes['width'];
            $class = @$attributes['class'];
            $id = @$attributes['id'];
        }
        $src = 'storage/' . $folder . '/' . $type . '/' . $img;
        if (!file_exists($src) || !$img) {
            return null;
        } else {
            $src = app()->make("url")->to('/') . '/' . $src;
        }
        return '<img  width="' . $width . '" src="' . $src . '" class="' . @$class . '" id="' . @$id . '" >';
    }
}
if (!function_exists('viewFile')) {
    function viewFile($file, $folder = 'uploads', $placeholder = null)
    {
        $path = $folder . '/' . $file;
        if (!$file || !file_exists($path)) {
            return '';
        }
        return '<i class="fa fa-paperclip"></i> <a href="' . $path . '" target="_blank" >' . $placeholder ?? $file . '</a>';
    }
}

if (!function_exists('unauthorizeWeb')) {
    function unauthorizeWeb()
    {
        return abort(403, 'Unauthorized action.');
    }
}

if (!function_exists('unauthorize')) {
    function unauthorize()
    {
        throw new HttpResponseException(response()->json([

            "errors" => [
                [
                    'status' => 403,
                    'title' => 'unauthorized_action',
                    'detail' => trans('app.Unauthorized action')
                ]
            ]

        ], 403));
    }
}

if (!function_exists('deleteMedia')) {
    function deleteMedia(
        $ids,
        object $model,
        string $storagePath = null
    ) {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $mediaData = $model->whereIn('id', $ids)->get();

        foreach ($mediaData as $media) {
            if (in_array($media->extension, getImageTypes())) {
                if (is_null($storagePath)) {
                    \File::delete(largePath() . '/' . $media->filename);
                    \File::delete(smallPath() . '/' . $media->filename);
                }
                \File::delete(largePath() . '/' . $storagePath . '/' . $media->filename);
                \File::delete(smallPath() . '/' . $storagePath . '/' . $media->filename);
            } else {
                if (is_null($storagePath)) {
                    \File::delete(largePath() . '/' . $media->filename);
                }
                \File::delete(largePath() . '/' . $storagePath . '/' . $media->filename);
            }
        }
        $model->whereIn('id', $ids)->delete();
    }
}
if (!function_exists('getImageTypes')) {
    function getImageTypes()
    {
        return [
            'jpeg',
            'png',
            'jpg',
            'gif',
            'svg'
        ];
    }
}

if (!function_exists('largePath')) {
    function largePath()
    {
        return storage_path('app/public/uploads/large');
    }
}
if (!function_exists('smallPath')) {
    function smallPath()
    {
        return storage_path('app/public/uploads/small');
    }
}

if (!function_exists('buildScopeRoute')) {
    /**
     * build Scope Route
     * @param $route , $param
     * @return string
     */
    function buildScopeRoute($route, array $param = [])
    {
        $params = ['language' => lang()];
        if (count($param) > 0) {
            $params = array_merge($params, $param);
        }
        return str_replace(url("api/v1") . "/" . lang(), str_replace(":lang", lang(), env("GATEWAY_URL")), route($route, $params));
    }
}

if (!function_exists('formatFilter')) {
    function formatFilter($data)
    {
        $arr = [];
        if (is_array($data) && count($data) > 0) {
            foreach ($data as $key => $value) {
                $obj = new stdClass();
                $obj->key = $key;
                $obj->value = $value;
                $arr[] = $obj;
            }
        }
        return $arr;
    }
}
if (!function_exists('createApiActionButtons')) {
    function createApiActionButtons($actions)
    {
        $returnActions = [];

        foreach ($actions as $action) {
            $returnActions[] = [
                'endpoint_url' => $action['endpoint_url'],
                'label' => $action['label'],
                'bg_color' => $action['bg_color'] ?? '#228B22',
                'key' => $action['key'] ?? null
            ];
        }
        return $returnActions;
    }
}
if (!function_exists('imageToLinkAndPath')) {
    function imageToLinkAndPath($images = [], $type = 'small')
    {
        if (!is_array($images)) {
            $images = [$images];
        }
        $result = [];
        foreach ($images as $image) {
            $result[] = [
                'path' => imageProfileApi($image, $type),
                'ext' => pathinfo($image, PATHINFO_EXTENSION)
            ];
        }
        return $result;
    }
}

if (!function_exists('checkLoginGuard')) {
    function checkLoginGuard()
    {
        if (auth('api')->check()) {
            return auth('api');
        } else {
            return auth();
        }
    }
}

if (!function_exists('formatFiltersForApi')) {
    function formatFiltersForApi($filters)
    {
        $result = [];
        foreach ($filters as $filter) {
            $filterResult = [];
            if (isset($filter['name'])) {
                $filterResult['name'] = $filter['name'];
            }
            if (isset($filter['type'])) {
                $filterResult['type'] = $filter['type'];
            }
            if (isset($filter['value'])) {
                $filterResult['value'] = $filter['value'];
            } else {
                $filterResult['value'] = null;
            }
            if (isset($filter['data'])) {
                $filterResult['data'] = formatFilter($filter['data']);
            }
            $result[] = $filterResult;
        }

        return $result;
    }
}

if (!function_exists('formatErrorValidation')) {
    /**
     *  JsonApi Error format Vlaidation
     * @param array $errors
     * @param int $code
     */
    function formatErrorValidation(array $errors, int $code = 422)
    {
        $errorsArray = [];
        foreach ($errors as $error) {
            if (is_array($error)) {
                $errorsArray[] = [
                    'status' => $error['status'],
                    'title' => Str::snake($error['title']),
                    'detail' => $error['detail'],
                ];
            } else {
                $errorsArray[] = [
                    'status' => $errors['status'],
                    'title' => Str::snake($errors['title']),
                    'detail' => $errors['detail'],
                ];
                break;
            }
        }
        return response()->json(["errors" => $errorsArray], $code);
    }
}
if (!function_exists('getNumberOfPercent')) {
    function getNumberOfPercent($number, $total)
    {
        return ($number / $total) * 100;
    }
}
function getMaxUploadSize()
{

    return min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
}

if (!function_exists('getMediaValidationRule')) {
    function getMediaValidationRule()
    {
        return trans('app.extentions') . " (" . implode(",", getImageTypes()) . ") , " . trans("app.dimentions") . ": (1400*900) ," . trans("app.max size") . ":" . getMaxUploadSize();
    }
}
if (!function_exists('getTitleFromSections')) {
    function getTitleFromSections($subjectFormatSubjects)
    {
        if ($subjectFormatSubjects->where('parent_subject_format_id', null)->count() >= 2) {
            return $subjectFormatSubjects->first()->subject->name;
        }
        $examTitle = '';
        foreach ($subjectFormatSubjects as $subjectFormatSubject) {
            if ($subjectFormatSubject != $subjectFormatSubjects->last()) {
                $examTitle .= $subjectFormatSubject->title . ' - ';
            } else {
                $examTitle .= $subjectFormatSubject->title;
            }
        }
        // any section in the sections collection will be enough
        // because all of them in the same level
        $examTitle = getTitleFromParentSections($examTitle, $subjectFormatSubjects->first());
        return $examTitle;
    }
}

if (!function_exists('getTitleFromParentSections')) {
    function getTitleFromParentSections($examTitle, $parentSection)
    {
        while ($parentSection->parentSubjectFormatSubject()->exists()) {
            $examTitle .= ' - ' . $parentSection->parentSubjectFormatSubject->title;
            $parentSection = $parentSection->parentSubjectFormatSubject;
        }
        $examTitle .= ' - ' . $parentSection->subject->name;
        return $examTitle;
    }
}

if (!function_exists('deleteQuestionMedia')) {
    function deleteQuestionMedia($media)
    {
        if (in_array($media->extension, getImageTypes())) {
            \File::delete(largePath() . '/' . $media->filename);
            \File::delete(smallPath() . '/' . $media->filename);
        } else {
            \File::delete(largePath() . '/' . $media->filename);
        }
        $media->delete();
    }
}

if (!function_exists('allowedQuestionsCountForExam')) {
    function allowedQuestionsCountForExam()
    {
        $allowedArr = [];
        for ($i = 1; $i <= 12; $i++) {
            array_push($allowedArr, 5 * $i);
        }
        return $allowedArr;
    }
}

if (!function_exists('dummyPicture')) {
    function dummyPicture()
    {
        return asset('img/avatar.png');
    }
}

if (!function_exists('randomEquation')) {

    function randomEquation()
    {
        $arrayOfEquations = [
            '<math xmlns="http://www.w3.org/1998/Math/MathML"><mfrac><mn>1</mn><mn>2</mn></mfrac><msqrt><mn>25</mn></msqrt></math>',
            '<math xmlns="http://www.w3.org/1998/Math/MathML"><mfenced open="|" close="|"><mrow><mo>-</mo><msqrt><mn>4</mn></msqrt></mrow></mfenced></math>',
            '<math xmlns="http://www.w3.org/1998/Math/MathML"><mfenced><mtable><mtr><mtd><mn>2</mn></mtd><mtd><mn>3</mn></mtd><mtd><mn>5</mn></mtd></mtr><mtr><mtd><mn>8</mn></mtd><mtd><mn>5</mn></mtd><mtd><mn>0</mn></mtd></mtr><mtr><mtd><mn>7</mn></mtd><mtd><mn>0</mn></mtd><mtd><mn>1</mn></mtd></mtr></mtable></mfenced><mo>&#xB7;</mo><mfenced open="[" close="]"><mtable><mtr><mtd><mn>6</mn></mtd></mtr><mtr><mtd><mo>-</mo><mn>5</mn></mtd></mtr><mtr><mtd><mn>9</mn></mtd></mtr></mtable></mfenced></math>'
        ];
        return $arrayOfEquations[array_rand($arrayOfEquations)];
    }
}

if (!function_exists('bringDBNotificationData')) {

    function bringDBNotificationData($title, $body, $screenType, $url)
    {

        foreach (config('translatable.locales') as $locale) {
            $multiLanguageData[$locale] =
                [
                    'title' => trans($title, [], $locale),
                    'body' => trans($body, [], $locale),
                ];
        }

        return [
            'data' => [
                'title' => trans($title),
                'body' => trans($body),
                'screen_type' => $screenType,
                'url' => $url,
                'localization' => $multiLanguageData,
            ]
        ];
    }
}


// given section, sorts parent section ids from subject down to it starting with its subject id (for breadcrumbs)
if (!function_exists('getBreadcrumbsIds')) {

    function getBreadcrumbsIds($subjectFormatSubject, $arr)
    {
        $arr[] = $subjectFormatSubject->id;
        if (isset($subjectFormatSubject->parentSubjectFormatSubject)) {
            return getBreadcrumbsIds($subjectFormatSubject->parentSubjectFormatSubject, $arr);
        }

        //add subject id
        $arr[] = $subjectFormatSubject->subject->id;
        $arr = array_reverse($arr);

        $result = [];
        foreach ($arr as $key => $value) {
            $data = [];
            $data['index'] = $key;
            $data['id'] = $value;
            $result[] = $data;
        }

        return $result;
    }
}
// given section, sorts parent section ids from subject down to it starting with its subject id (for breadcrumbs)
if (!function_exists('getDynamicLink')) {
    function getDynamicLink($link, $params = [])
    {

        foreach ($params as $key => $value) {
            $link = str_replace('{' . $key . '}', $value, $link);
        }
        return ($link);
    }
}

if (!function_exists('buildTranslationKey')) {
    function buildTranslationKey(string $trans_key, array $trans_params = [])
    {
        if (count($trans_params)) {
            $translation = [
                'trans_key' => $trans_key,
                'trans_params' => $trans_params
            ];
        } else {
            $translation = $trans_key;
        }
        return ($translation);
    }
}
if (!function_exists('displayTranslation')) {
    function displayTranslation($key, $lang = null)
    {
        if (is_array($key)) {
            $translation = trans($key['trans_key'], $key['trans_params'], $lang);
        } else {
            $translation = trans($key, [], $lang);
        }
        return ($translation);
    }
}
if (!function_exists('truncateString')) {

    function truncateString($text, $length)
    {
        $length = abs((int)$length);
        if (strlen($text) > $length) {
            $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
        }
        return ($text);
    }
}
