<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Topic;

    class TopicController extends Controller
    {
        public function TopicsAll(){
            $Topics = Topic::all();
            return view('Topics.TopicsAll', compact('Topics'));
        }

        public function listTopicById($id){
            $topic = topic::findOrFail($id);
            return view('Topics.listTopicById', compact('topic'));
        }

        public function createTopic()
        {
            return view('Topics.createTopic');
        }

        public function store(Request $request){
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
            ]);

            $topic = new Topic;
            $topic->title = $request->title;
            $topic->description = $request->description;
            $topic-save();

            return redirect()->route('TopicsAll')->with('success', 'Topics created successfully');

        }

        public function editTopic($id){
            $topic = Topic::findOrFall($id);
            return view('Topics.editTopic', compact('topics'));
        }

        public function updateTopic(Request $request, $id){
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
            ]);

            $topic = Topic::findOrFail($id);
            $topic->title = $request->title;
            $topic->description = $request->description;
            $topic->save();

            return redirect()->route('TopicsAll')->with('success', 'Topic updated successfully');
        }

        public function deleteTopic($id){
            $topic = Topic::findOrFail($id);
            $topic->delete();

            return redirect()->route('TopicsAll')->with('success', 'Topic deleted successfully');
        }
    }