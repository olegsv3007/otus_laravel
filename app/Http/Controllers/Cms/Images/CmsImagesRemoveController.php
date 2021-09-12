<?php

namespace App\Http\Controllers\Cms\Images;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;

class CmsImagesRemoveController extends Controller
{
    public function __invoke(Image $image): RedirectResponse
    {
        if ($image->exists) {
            $image->delete();
        }

        return redirect()->back();
    }
}
