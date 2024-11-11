<?php

namespace App\Traits;

trait ProcessingTrait
{
    public function processImageAndData($request, $data, $folder)
    {
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/' . $folder), $imageName);
            $data['img'] = $imageName;
        }
        if ($request->hasFile('cv')) {
            $image = $request->file('cv');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('cvs/' . $folder), $imageName);
            $data['cv'] = $imageName;
        }
        return $data;
    }

    public function processImage($image, $data, $folder)
    {
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/' . $folder), $imageName);
            return $imageName;
        }

        return $data;
    }

    private function getTranslatedNames($request)
    {
        return [
            'ar' => $request->AR_name,
            'en' => $request->EN_name,
        ];
    }
    private function getTranslatedStatus($request)
    {
        return [
            'ar' => $request->AR_status,
            'en' => $request->EN_status,
        ];
    }
    private function getTranslatedDesc($request)
    {
        return [
            'ar' => $request->AR_desc,
            'en' => $request->EN_desc,
        ];
    }
}
