<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;

class ContactController extends Controller
{
    // 入力画面
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    // 確認画面
    public function confirm(ContactRequest $request)
    {
    $inputs = $request->all();
    $categories = \App\Models\Category::all(); // ← これを追加

    return view('contact.confirm', compact('inputs', 'categories'));
    }

    public function back(Request $request)
{
    return redirect()
        ->route('contact.index')
        ->withInput();
}

    // データ保存
    public function store(Request $request)
    {
        if ($request->input('action') === 'back') {
            return redirect()->route('contact.index')->withInput();
        }

        // 念のためstoreでもtelを結合しておく（confirm後の戻る対応などで必要な場合）
        $request->merge([
            'tel' => $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3,
        ]);

        Contact::create($request->except(['action', 'tel1', 'tel2', 'tel3']));


        return redirect('/thanks');
    }
}
