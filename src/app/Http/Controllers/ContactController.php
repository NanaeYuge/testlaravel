<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    //お問い合わせフォームの入力画面
    public function index()
    {
        $categories = Category::all();
        return view('contact.contact', compact('categories'));
    }

    // 確認画面にデータを渡す
    public function confirm(Request $request)
    {
        $request->validate([
            'last_name' => ['required'],
            'first_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'numeric'],
            'tel2' => ['required', 'numeric'],
            'tel3' => ['required', 'numeric'],
            'address' => ['required'],
            'category_id' => ['required'],
            'message' => ['required', 'max:120'],
        ], [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.numeric' => '電話番号は5桁までの数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.numeric' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'message.required' => 'お問い合わせ内容を入力してください',
            'message.max' => 'お問合せ内容は120文字以内で入力してください',
        ]);

        $inputs = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1', 'tel2', 'tel3',
            'address', 'building',
            'category_id', 'message'
        ]);
        $categoryName = Category::find($inputs['category_id'])->content ?? '不明';

        return view('confirm', compact('inputs', 'categoryName'));
    }

    //送信
    public function send(Request $request)
{
    if ($request->input('action') === 'back') {
        return redirect()->route('contact.index')->withInput();
    }
    $contactData = $request->only([
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'category_id',
        'message'
    ]);

    Contact::create($contactData);

    return redirect()->route('thanks');
}

    //サンクスページ
    public function thanks()
    {
        return view('thanks');

    }

}