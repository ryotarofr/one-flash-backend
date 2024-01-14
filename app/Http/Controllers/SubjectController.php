<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        $subject = Subject::all();

        $data = [
            'status' => 200,
            'subject' => $subject
        ];

        return response()->json($data, 200);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_kanji' => 'required',
            'name_kana' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'nearest_station' => 'required',
            'self_introduction' => 'required',
            'stature' => 'required',
            'weight' => 'required',
            'transportation' => 'required',
        ]);

        if ($validator->fails()) {

            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data, 422);
        } else {

            $subject = new Subject();

            $subject->name_kanji = $request->name_kanji;
            $subject->name_kana = $request->name_kana;
            $subject->email = $request->email;
            $subject->phone = $request->phone;
            $subject->nearest_station = $request->nearest_station;
            $subject->self_introduction = $request->self_introduction;
            $subject->stature = $request->stature;
            $subject->weight = $request->weight;
            $subject->transportation = $request->transportation;
            $subject->save();

            $picturesData = $request->input('pictures', []);
            foreach ($picturesData as $pictureData) {
                $picture = Picture::create([
                    'picture' => $pictureData['picture']
                ]);

                // SubjectとPictureを関連付ける
                $subject->pictures()->save($picture);
            }


            $data = [
                'status' => 200,
                'message' => 'データを追加しました!!'
            ];

            return response()->json($data, 200);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_kanji' => 'required',
            'name_kana' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'nearest_station' => 'required',
            'self_introduction' => 'required',
            'stature' => 'required',
            'weight' => 'required',
            'transportation' => 'required',
        ]);

        if ($validator->fails()) {

            $data = [
                'status' => 422,
                'message' => $validator->messages()
            ];
            return response()->json($data, 422);
        } else {
            $subject = Subject::find($id);

            $subject->name = $request->name;
            $subject->email = $request->email;
            $subject->phone = $request->phone;

            $subject->save();

            $data = [
                'status' => 200,
                'message' => 'データを更新しました!!'
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id)
    {
        $subject = Subject::find($id);

        $subject->delete();

        $data = [
            'status' => 200,
            'message' => 'データを削除しました!!'
        ];

        return response()->json($data, 200);
    }
}
