<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
// use Intervention\Image\Facades\Image as ResizeImage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['nullable', 'image', 'max:1024'],
            // 'phone' => ['required', 'numeric', 'digits_between:10,12'],
            'address' => ['required', 'string', 'max:255'],
            // 'role' => ['required', 'string', 'in:user,admin,superAdmin'],

        ]);

        $imageName = null;
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME). time() . '.' . 'webp';
        //     $path = public_path('testimonial/');
        //     ResizeImage::make($image)
        //     ->save($path . $imageName, 60);
        // }

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imageName,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role ?? 'admin',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
