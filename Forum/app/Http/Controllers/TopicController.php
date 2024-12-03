<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Topic;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use App\Models\Category;

    class TopicController extends Controller
    {
        public function listAllTopics(){
            $Topics = Topic::all();
            return view('Topics.TopicsAll', compact('Topics'));
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
            // Validação dos dados do Topic (sem a imagem)
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'nullable|string',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:tags,id',
            ]);
        
            // Criando o tópico (sem imagem diretamente)
            $topic = Topic::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category_id' => $request->category_id,
            ]);
        
            // Validação para a imagem do Post
            $request->validate([
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validação para a imagem no Post
            ]);
        
            // Criando o post associado ao tópico (onde a imagem é armazenada)
            $post = $topic->post()->create([
                'user_id' => auth()->id(),
                'image' => $request->hasFile('image') ? $request->file('image')->store('posts/images') : null, // Armazenando a imagem do post
            ]);
        
            // Sincronizando as tags associadas ao tópico
            if ($request->has('tags')) {
                $topic->tags()->sync($request->tags);
            }

            if ($user->suspended) {
                return redirect()->route('listAllTopics')->with('error', 'Você está suspenso e não pode criar tópicos.');
            }
        
            // Redirecionando para a página desejada
            $redirectRoute = $request->input('viewName') === 'home' ? 'home' : 'listAllTopics';
            return redirect()->route($redirectRoute)->with('success', 'Topic created successfully.');
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
        if (!Auth::user())
            return ("Unauthorized");
            
        $userId = Auth::id();
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required'
        ]);

            $topic = Topic::create([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category_id' => $request->category
            ]);

            Auth::user()->$topic->post()->create([
                'user_id' => Auth::id(),
                'image' => $request->image,
                // 'image' => $request->file('image')->store('images', 'public')
            ]);

            return redirect()->route('TopicsAll')->with('success', 'Topics created successfully');

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