<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
use App\Bookmark;
use App\Category;
use App\Group;
use App\Notification;
use App\User;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    // Default route
    Route::get('/', function(){ 
        if (Auth::check()){
            return redirect('/home');
        } else {
            return view('splashpage');
        }
    });

    // Authentication routes
    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('/logout', function(){
        /**
         * modified from http://stackoverflow.com/a/28757857
         * as default auth/logout wasn't working for me
         */
        Auth::logout();
        Session::flush();
        return redirect('/');
    });

    // Registration routes
    Route::get('/register', 'Auth\AuthController@getRegister');
    Route::post('/register', 'Auth\AuthController@postRegister');

    // Password reset link request routes
    Route::get('/password/email', 'Auth\PasswordController@getEmail');
    Route::post('/password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes
    Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('/password/reset', 'Auth\PasswordController@postReset');

    // Post-Authentication Homepage
    Route::get('/home', function(){
        if (Auth::check()){
            $groups = Group::whereHas('users', function($q){
                $q->where('id', '=', Auth::id());
            })->get();

            return view('home', [
                'groups' => $groups,
                'categories' => Auth::user()->categories()->get(),
                'notifications' => Auth::user()->notifications()->get(),
            ]);
        } else {
            return redirect('/');
        }
    });

    // Manage User
    /**
     * GET /edit-account
     * Present form to update name or email for authenticated user
     * Change password link will be provided
     */
    Route::get('/edit-account', function(){
        if (Auth::check()){
            return view('edit-account', [ 'user' => Auth::user() ]);
        } else {
            return redirect('/');
        }
    });
    /**
     * POST /edit-account
     * Update name or email for authenticated user
     */
    Route::post('/edit-account', function(Request $request){
        if (Auth::check()){
            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect()->back()->withInput()->withErrors($v);
            }

            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->back();
        } else {
            return redirect('/');
        }
    });
    /**
     * DELETE /user/{id}
     * Delete the user corresponding to {id}
     */
    Route::delete('/user/{id}', function($id){
        if (Auth::check()){
            Auth::user()->delete();
        }
        return redirect('/');
    });

    // Manage Groups
    /**
     * GET /groups
     * Display existing groups for authenticated user
     *
     * Present form for creating new group
     */
    Route::get('/groups', function(){
        if (Auth::check()){
            $groups = Group::whereHas('users', function($q){
                $q->where('id', '=', Auth::id());
            })->get();

            return view('groups', ['groups' => $groups]);
        } else {
            return redirect('/');
        }
    });
    /**
     * POST /groups
     * Create a new group and add authenticated user to it
     */
    Route::post('/groups', function(Request $request){
        if (Auth::check()){
            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect()->back()->withInput()->withErrors($v);
            }

            // Create New Group
            $group = new Group;
            $group->name = $request->name;
            $group->description = trim($request->description);
            $group->save();
            $group->users()->save(Auth::user());

            return redirect()->back();
        } else {
            return redirect('/');
        }
    });
    /**
     * DELETE /group/{id}
     * Delete the group corresponding to {id}
     */
    Route::delete('/group/{id}', function($id){
        if (Auth::check()){
            $group = Group::findOrFail($id);
            $group->users()->where('id', '=', Auth::id())->detach();

            return redirect('/groups');
        } else {
            return redirect('/');
        }
    });
    /**
     * GET /join-groups
     * List all groups
     */
    Route::get('/join-groups', function(){
        if (Auth::check()){
            $groups = Group::all();

            return view('join-groups', ['groups' => $groups]);
        } else {
            redirect('/');
        }
    });
    /**
     * GET /join-group/{id}
     * Add authenticated user to group corresponding to {id}
     */
    Route::get('/join-group/{id}', function($id){
        if (Auth::check()){
            $group = Group::findOrFail($id);
            $group->users()->save(Auth::user());

            $groups = Group::all();

            return redirect('/groups');
        } else {
            return redirect('/');
        }
    });
    /**
     * GET /edit-group/{id}
     * Present edit form for group corresponding to {id}
     *
     * Present interface for inviting users to this group
     */
    Route::get('/edit-group/{id}', function($id){
        if (Auth::check()){
            $group = Group::findOrFail($id);
            $users = User::where('id', '!=', Auth::id())->get();

            return view('edit-group', [
                'group' => $group,
                'users' => $users,
            ]);
        } else {
            return redirect('/');
        }
    });
    /**
     * POST /edit-group
     * Update name, description, and membership of group with specified {id}
     */
    Route::post('/edit-group', function(Request $request){
        if (Auth::check()){
            $group = Group::findOrFail($request->id);

            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect()->back()->withInput()->withErrors($v);
            }

            $group->name = $request->name;
            $group->description = trim($request->description);
            $group->save();

            return redirect('/edit-group/'.$request->id);
        } else {
            return redirect('/');
        }
    });

    // Manage Categories
    /**
     * POST /add-category
     * Create new Category and attach authenticated User to it
     */
    Route::post('/add-category', function(Request $request){
        if (Auth::check()){
            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect('/home')->withInput()->withErrors($v);
            }

            $category = new Category;
            $category->name = $request->name;
            $category->description = trim($request->description);
            $category->user_id = Auth::id();
            $category->save();

            return redirect('/home');
        } else {
            return redirect('/');
        }
    });
    /**
     * GET /edit-category/{id}
     * Present edit form for category corresponding to {id}
     *
     * Present interface for adding bookmarks to this Category
     */
    Route::get('/edit-category/{id}', function($id){
        if (Auth::check()){
            $category = Category::findOrFail($id);

            return view('edit-category', [
                'category' => $category,
                'bookmarks' => $category->bookmarks()->get(),
            ]);
        } else {
            return redirect('/');
        }
    });
    /**
     * POST /edit-category
     * Update name, description, and bookmarks for category with specified {id}
     */
    Route::post('/edit-category', function(Request $request){
        if (Auth::check()){
            $category = Category::findOrFail($request->id);

            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect()->back()->withInput()->withErrors($v);
            }

            $category->name = $request->name;
            $category->description = trim($request->description);
            $category->save();

            return redirect('/home');
        } else {
            return redirect('/');
        }
    });
    /**
     * DELETE /category/{id}
     * Delete the category at the associated {id}
     */
    Route::delete('/category/{id}', function($id){
        if (Auth::check()){
            $category = Category::findOrFail($id);
            $category->bookmarks()->detach();
            $category->delete();
            return redirect('/home');
        } else {
            return redirect('/');
        }
    });


    // Manage Bookmarks
    /**
     * POST /add-bookmark
     * Create new Bookmark in selected Category
     */
    Route::post('/add-bookmark', function(Request $request){
        if (Auth::check()){
            $category = Category::findOrFail($request->category_id);
            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'url' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect()->back()->withInput()->withErrors($v);
            }

            $bookmark = new Bookmark;
            $bookmark->name = $request->name;
            $bookmark->url = $request->url;
            $bookmark->description = trim($request->description);
            $bookmark->user_id = Auth::id();
            $bookmark->save();
            $bookmark->categories()->save($category);

            return redirect()->back();
        } else {
            return redirect('/');
        }
    });
    /**
     * GET /edit-bookmark/{id}
     * Present edit form for bookmark corresponding to {id}
     */
    Route::get('/edit-bookmark/{id}', function($id){
        if (Auth::check()){
            $bookmark = Bookmark::findOrFail($id);
            $users = User::where('id', '!=', Auth::id())->get();

            return view('edit-bookmark', [
                'bookmark' => $bookmark,
                'users' => $users,
            ]);
        } else {
            return redirect('/');
        }
    });
    /**
     * POST /edit-bookmark
     * Update name, description, and urls for bookmark with specified {id}
     */
    Route::post('/edit-bookmark', function(Request $request){
        if (Auth::check()){
            $bookmark = Bookmark::findOrFail($request->id);

            $v = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'url' => 'required|max:255',
            ]);

            if ($v->fails()){
                return redirect()->back()->withInput()->withErrors($v);
            }

            $bookmark->name = $request->name;
            $bookmark->url = $request->url;
            $bookmark->description = trim($request->description);
            $bookmark->save();

            return redirect('/home');
        } else {
            return redirect('/');
        }
    });
    /**
     * DELETE /bookmark/{id}
     * Delete the bookmark at the associated {id}
     */
    Route::delete('/bookmark/{id}', function($id){
        if (Auth::check()){
            $bookmark = Bookmark::findOrFail($id);
            $bookmark->categories()->detach();
            $bookmark->delete();
            return redirect('/home');
        } else {
            return redirect('/');
        }
    });

    /**
     * POST /send-message
     * Send a message to another user
     */
    Route::post('/send-message', function(Request $request){
        if (Auth::check()){
            $target_user = User::findOrFail($request->user_id);
            $notify = new Notification;
            $notify->user_id = $target_user->id;
            /* would probably sanitize this input more in a real system */
            $notify->message = trim($request->message);
            $notify->read = false;
            $notify->save();
        } else {
            return redirect('/');
        }
    });
    /**
     * GET /messages/unread
     * View unread messages for authenticated user
     */
    Route::get('/messages/unread', function(){
        if (Auth::check()){
            $notifications = Auth::user()->notifications()
                                         ->where(['read' => false])->get();
            return view('unread-messages', [
                'notifications' => $notifications,
            ]);
        } else {
            return redirect('/');
        }
    });
});
