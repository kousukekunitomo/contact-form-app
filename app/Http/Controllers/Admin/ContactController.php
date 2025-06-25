<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category')->latest();

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->name . '%')
                  ->orWhere('first_name', 'like', '%' . $request->name . '%')
                  ->orWhere('email', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin.contacts.index', compact('contacts', 'categories'));
    }

    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    public function destroy($id)
{
    Contact::findOrFail($id)->delete(); // 論理削除

    // 一時的にメッセージを無効化
    // return redirect()->route('admin.contacts.index')->with('message', '削除しました');

    return redirect()->route('admin.contacts.index');
}

    public function export(Request $request): StreamedResponse
    {
        $contacts = Contact::with('category')
            ->when($request->filled('name'), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', "%{$request->name}%")
                          ->orWhere('last_name', 'like', "%{$request->name}%");
                });
            })
            ->when($request->filled('email'), fn ($q) =>
                $q->where('email', 'like', "%{$request->email}%"))
            ->when($request->filled('gender'), fn ($q) =>
                $q->where('gender', $request->gender))
            ->when($request->filled('category_id'), fn ($q) =>
                $q->where('category_id', $request->category_id))
            ->when($request->filled('date'), fn ($q) =>
                $q->whereDate('created_at', $request->date))
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];

        $callback = function () use ($contacts) {
            $stream = fopen('php://output', 'w');

            // ✅ UTF-8 BOM を追加してExcel文字化け防止
            fwrite($stream, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // ヘッダー行
            fputcsv($stream, ['ID', '氏名', '性別', 'メール', 'お問い合わせ種類', '日付']);

            foreach ($contacts as $contact) {
                fputcsv($stream, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    ['男性', '女性', 'その他'][$contact->gender - 1],
                    $contact->email,
                    $contact->category->content ?? '',
                    $contact->created_at->format('Y-m-d'),
                ]);
            }

            fclose($stream);
        };

        return response()->stream($callback, 200, $headers);
    }
}
