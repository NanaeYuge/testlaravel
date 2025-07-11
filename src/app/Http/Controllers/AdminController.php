<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;



class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('last_name', 'like', "%$keyword%")
                ->orWhere('first_name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('content', $request->type);
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->paginate(7)->appends($request->query());

        return view('admin.index', compact('contacts'));
    }

    public function show($id)
{
    $contact = Contact::with('category')->find($id);

    if (!$contact) {
        return response()->json(['error' => 'データが見つかりません'], 404);
    }

    return response()->json([
        'id' => $contact->id,
        'last_name' => $contact->last_name,
        'first_name' => $contact->first_name,
        'gender' => $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他'),
        'email' => $contact->email,
        'tel1' => $contact->tel1,
        'tel2' => $contact->tel2,
        'tel3' => $contact->tel3,
        'address' => $contact->address,
        'building' => $contact->building,
        'category_content' => $contact->category->content ?? '',
        'message' => $contact->message,
    ]);
}

    public function export(Request $request): StreamedResponse
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('last_name', 'like', "%$keyword%")
                ->orWhere('first_name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%");
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        if ($request->filled('type')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('content', $request->type);
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=contacts.csv",
        ];

        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種類', 'お問い合わせ内容', 'お問い合わせ日']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name,
                    $contact->first_name,
                    $this->formatGender($contact->gender),
                    $contact->email,
                    $contact->tel,
                    optional($contact->category)->name ?? '未設定',
                    $contact->detail,
                    $contact->created_at->format('Y/m/d'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function formatGender($gender)
{
    return ['1' => '男性', '2' => '女性', '3' => 'その他'][$gender] ?? '未設定';
}

public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();
    return response()->json(['success' => true]);
}


    public function detail(Contact $contact)
{
    return view('admin.detail', compact('contact'));
}

    public function __construct()
{
        $this->middleware('auth');

}

}

