<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Topic;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use App\Models\Category;
    use App\Models\Tag  ;

    class TopicController extends Controller
    {
        public function listAllTopics()
        {
            $topics = Topic::with('comments')->get();
            return view('topics.createTopics', ['topics' => $topics]);
        }
    

        public function listTopicById($id){
            $topic = topic::findOrFail($id);
            return view('Topics.TopicsAll', compact('topics'));
        }

        public function showCreateForm()
        {
            return view('topics.createTopics'); 
        }


        public function createTopic(Request $request)
        {
            $categories = Category::all();
            $tags = Tag::all();
            return view('topics.createTopics', ['categories' => $categories, 'tags' => $tags]);
        }
        
        public function showTopics(Request $request)
    {

    
        // Incluir votos do usuário autenticado
        $query->with(['post' => function ($query) {
            $query->with('rates')->withCount([
                'rates as likes_count' => function ($query) {
                    $query->where('vote', 1);
                },
                'rates as dislikes_count' => function ($query) {
                    $query->where('vote', 0);
                },
            ])->get()->each->setAppends(['user_vote']);
        }]);
    

    
        $topics = $query->get();
        $categories = Category::all();
        $suggestedUsers = User::inRandomOrder()->take(5)->get();
        $tags = Tag::all();
    
        return view('welcome', compact('topics', 'categories', 'suggestedUsers', 'tags'));
    }

        public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'status' => 'required|int',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $topic = Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category
        ]);

        $topic->post()->create([
            'user_id' => Auth::id(),
            'image' => $request->image ?? '',
            // 'image' => $request->file('image')->store('images', 'public')
        ]);

        // $topic = new Topic([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'status' => $request->status,
        //     'category_id' => $request->category
        // ]);

        // $post = new Post([
        //     'image' => $request->image
        // ]);

        
        // $topic->post()->save($post);



        return($topic);

        }

        public function editTopic($id){
            $topic = Topic::findOrFall($id);
            return view('Topics.editTopic', compact('topics'));
        }

        public function updateTopic(Request $request, $id)
        {
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'status' => 'required|boolean',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:tags,id',
                'viewName' => 'nullable|string', 
            ]);
        
            $topic = Topic::findOrFail($id);
            
            $topic->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);
        
            if ($request->has('tags')) {
                $topic->tags()->sync($request->tags);
            } else {
                $topic->tags()->sync([]);
            }
        
            $redirectRoute = $request->viewName === 'home' ? 'home' : 'listAllTopics';
        
            return redirect()->route($redirectRoute)->with('success', 'Topic updated successfully.');
        }

        public function deleteTopic($id){
            $topic = Topic::findOrFail($id);
            $topic->delete();

            return redirect()->route('TopicsAll')->with('success', 'Topic deleted successfully');
        }
    }