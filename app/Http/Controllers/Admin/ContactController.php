<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts.
     */
    public function index()
    {
        return view('admin.contacts.index');
    }

    /**
     * Get contacts data for DataTables.
     */
    public function getData()
    {
        $contacts = Contact::select('contacts.*');

        return DataTables::of($contacts)
            ->addColumn('status', function ($contact) {
                $status = $contact->is_read ? 'Read' : 'Unread';
                $color = $contact->is_read ? 'success' : 'warning';
                return '<span class="badge bg-' . $color . '">' . $status . '</span>';
            })
            ->addColumn('message_preview', function ($contact) {
                return strlen($contact->message) > 50 ? substr($contact->message, 0, 50) . '...' : $contact->message;
            })
            ->addColumn('actions', function ($contact) {
                $readBtn = $contact->is_read ?
                    '<button class="btn btn-sm btn-outline-secondary me-1" disabled><i class="fas fa-envelope-open"></i></button>' :
                    '<button class="btn btn-sm btn-outline-info me-1" onclick="markAsRead(' . $contact->id . ')" title="Mark as Read"><i class="fas fa-envelope"></i></button>';

                return $readBtn . '
                    <a href="#" class="btn btn-sm btn-outline-primary me-1" title="View Full Message" onclick="viewMessage(' . $contact->id . ')">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="confirmDelete(' . $contact->id . ')">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    /**
     * Mark a contact message as read.
     */
    public function markRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Message marked as read'
        ]);
    }
}