<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectWithUserController extends Controller
{
    public function index($user_id)
    {
        // user_idカラムと一致するレコードを取得
        $subject = Subject::where('user_id', $user_id)->get();

        $data = [
            'status' => 200,
            'subject' => $subject
        ];

        return response()->json($data, 200);
    }

    public function upload(Request $request, $user_id)
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
            $subject->user_id = $user_id; // user_idに紐つける
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

    public function edit(Request $request, $user_id, $subject_id)
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
            $subject = Subject::where('user_id', $user_id)->find($subject_id);

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
                'message' => 'データを更新しました!!'
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($user_id, $subject_id)
    {
        $subject = Subject::where('user_id', $user_id)->find($subject_id);

        // 関連する pictures レコードを削除
        $subject->pictures()->delete();

        $subject->delete();

        $data = [
            'status' => 200,
            'message' => 'データを削除しました!!'
        ];

        return response()->json($data, 200);
    }
}
