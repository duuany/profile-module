<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Modules\Profile\Http\Requests\ProfileFormRequest;
use Modules\Profile\Models\Profile;

class ProfileController extends Controller
{
    use AuthorizesRequests;

    /**
     * Gets the User Model
     * @param $value
     * @return mixed
     */
    protected function getUser($value)
    {
        return app()->make(config('profile.user.model'))
                    ->where(config('profile.user.route-key-name'), $value)
                    ->firstOrFail();
    }

    /**
     * Show the form for creating a new resource.
     * @return mixed
     */
    public function create($email)
    {
        $user = $this->getUser($email);

        return view('profile::create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  ProfileFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileFormRequest $request)
    {
        $user = auth()->user();
        $user->profile()->save(Profile::on()->make($request->all()));

        flash()->success(Lang::get('profile::' . config('app.locale') . '.created'));

        return redirect()->route('profile.show', $user);
    }

    /**
     * Show the specified resource.
     * @return mixed
     */
    public function show($email)
    {
        $this->authorize('profile.access', $email);

        $user = $this->getUser($email)->load('profile');

        return view('profile::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return mixed
     */
    public function edit($email)
    {
        $this->authorize('profile.access', $email);

        $user = $this->getUser($email)->load('profile');

        return view('profile::edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param ProfileFormRequest $request
     * @param Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileFormRequest $request, Profile $profile)
    {
        $profile->update($request->all());

        flash()->info(Lang::get('profile::' . config('app.locale') . '.updated'));

        return redirect()->route('profile.show', auth()->user());
    }

    /**
     * Remove the specified resource from storage.
     * @param Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $this->authorize('profile.access', $profile->user->email);

        $profile->delete();

        flash()->error(Lang::get('profile::' . config('app.locale') . '.deleted'));

        return redirect()->route('profile.show', auth()->user());
    }
}
