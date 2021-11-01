<?php


namespace Database\Factories\BaseApp\Models;

use App\BaseApp\Models\UploadedMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class UploadedMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UploadedMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'source_filename' => 'default.jpg',
            'filename' => 'default.jpg',
            'file_path' => 'core/storage/app/public/uploaded_media/default.jpg',
            'size' => '4357',
            'extension' => 'jpg',
        ];
    }
}
