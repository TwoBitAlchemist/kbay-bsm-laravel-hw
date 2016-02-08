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
use App\Category;
use App\Group;
use App\User;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    // Default route
    Route::get('/', function(){ return view('splashpage'); });

    // Authentication routes
    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('/logout', 'Auth\AuthController@getLogout');

    // Registration routes
    Route::get('/register', 'Auth\AuthController@getRegister');
    Route::post('/register', 'Auth\AuthController@postRegister');

    // Post-Authentication Homepage
    Route::get('/home', function(){
        $groups = Group::whereHas('users', function($q){
            $q->where('id', '=', Auth::id());
        })->get();
        $categories = Category::whereHas('users', function($q){
            $q->where('id', '=', Auth::id());
        })->get();

        return view('home', [
            'groups' => $groups,
            'categories' => $categories,
        ]);
    });

    // Manage Groups
    /**
     * GET /groups
     * Display existing groups for authenticated user
     *
     * Present form for creating new group
     */
    Route::get('/groups', function(){
        $groups = Group::whereHas('users', function($q){
            $q->where('id', '=', Auth::id());
        })->get();

        return view('groups', ['groups' => $groups]);
    });
    /**
     * POST /groups
     * Create a new group and add authenticated user to it
     */
    Route::post('/groups', function(Request $request){
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
    });
    /**
     * GET /join-groups
     * List all groups
     */
    Route::get('/join-groups', function(){
        $groups = Group::all();

        return view('join-groups', ['groups' => $groups]);
    });
    /**
     * GET /edit-group/{id}
     * Present edit form for group corresponding to {id}
     *
     * Present interface for inviting users to this group
     */
    Route::get('/edit-group/{id}', function($id){
        $group = Group::findOrFail($id);
        $users = User::all();

        return view('edit-group', [
            'group' => $group,
            'users' => $users,
        ]);
    });
    /**
     * POST /edit-group
     * Update name, description, and membership of group with specified {id}
     */
    Route::post('/edit-group', function(Request $request){
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
    });

    // Manage Categories
    /**
     * POST /add-category
     * Create new Category and attach authenticated User to it
     */
    Route::post('/add-category', function(Request $request){
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($v->fails()){
            return redirect('/home')->withInput()->withErrors($v);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->description = trim($request->description);
        $category->save();
        $category->users()->save(Auth::user());

        return redirect('/home');
    });
    /**
     * GET /edit-category/{id}
     * Present edit form for category corresponding to {id}
     *
     * Present interface for adding bookmarks to this Category
     */
    Route::get('/edit-category/{id}', function($id){
        $category = Category::findOrFail($id);

        return view('edit-category', [
            'category' => $category,
        ]);
    });
    /**
     * POST /edit-category
     * Update name, description, and bookmarks for category with specified {id}
     */
    Route::post('/edit-category', function(Request $request){
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
    });
    /**
     * DELETE /category/{id}
     * Delete the category at the associated {id}
     */
    Route::delete('/category/{id}', function($id){
        $category = Category::findOrFail($id);
        $category->users()->detach();
        $category->delete();
        return redirect('/home');
    });
});
