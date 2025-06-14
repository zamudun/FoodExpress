<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function update(Request $user)
{
    $id = Auth::id();

    // We will modify the validation rules inside this block
    $user->validate([
        'email' => [
            'required',
            Rule::unique('users')->ignore($id),
        ],
        'name' => 'required',
        // REPLICATE THE ADDRESS RULE HERE
        'address' => ['required', 'string', 'max:255',
            function ($attribute, $value, $fail) {
                // Check if the address contains 'Kuala Lumpur' OR 'KL' (case-insensitive)
                if (stristr($value, 'Kuala Lumpur') === false && stristr($value, 'KL') === false) {
                    // If it doesn't contain either, fail the validation with a custom message.
                    $fail('Sorry, service is currently only available for addresses in Kuala Lumpur.');
                }
            },
        ],
    ]);

    // The rest of the function remains the same
    User::where('id', $id)->update([
        'name' => $user['name'],
        'email' => $user['email'],
        'address' => $user['address'],
    ]);

    Session::flash('success', 'Successfully edited your profile.');
    return redirect('/home');
}

    public function updateView()
    {
        if (!Auth::check()) {
            session()->flash('unauthorized', 'You are not authorized to access the page ' . request()->path());
            return redirect('../home');
        }
        $user = User::findOrFail(Auth::id());
        return view('editUser', ['user' => $user]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $orders = Order::where('user_id', $id)->get();
        // For each food in the order:
        foreach ($orders as $order) {
            foreach ($order->food as $food){
                // Remove from pivot table
                $order->food()->detach($food->id);
            }
            $order->delete();
        }
        Session::flash('success', 'Successfully deleted your account.');
        return redirect('logout');
    }
}
