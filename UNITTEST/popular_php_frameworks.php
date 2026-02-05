<?php

/**
 * Most Popular PHP Frameworks & Their Usage
 */

// 1. LARAVEL - Most Popular PHP Framework
// Route example
Route::get('/users', function () {
    return User::all();
});

// Controller example
class UserController extends Controller
{
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    public function store(Request $request)
    {
        $user = User::create($request->validated());
        return response()->json($user, 201);
    }
}

// Eloquent ORM example
class User extends Model
{
    protected $fillable = ['name', 'email'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

// 2. SYMFONY - Enterprise Framework
// Controller example
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', methods: ['GET'])]
    public function list(): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->json($products);
    }
}

// 3. CODEIGNITER - Lightweight Framework
class Welcome extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function users()
    {
        $this->load->model('user_model');
        $data['users'] = $this->user_model->get_all_users();
        $this->load->view('users', $data);
    }
}

// 4. ZEND/LAMINAS - Modular Framework
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([
            'message' => 'Hello World'
        ]);
    }
}

// 5. CAKEPHP - Convention over Configuration
class ArticlesController extends AppController
{
    public function index()
    {
        $articles = $this->Articles->find('all');
        $this->set(compact('articles'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $this->Articles->save($article);
        }
        $this->set('article', $article);
    }
}
