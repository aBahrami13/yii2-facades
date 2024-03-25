# yii2-facades
Facades support for Yii 2 application components &amp; classes like Laravel

## 🟡 Installation

### Step 1

Run `composer require abahrami13/yii2-facades` command.

### Step 2

Add `abahrami13\facades\RegisterFacadeAutoloader` to the `bootstrap` array in the configuration file (`config/web.php` in the basic template).

## 🟡 Usage

### 🔷 Components facades namespaces

#### 1) Yii2 Components
To use component facade, just import a class started with `facades\` followed by the component id. For example for using facade of request component just import `facades\Request`:

`use facades\Request;`

#### 2) Other Classes
To use facade for other classes, just add `facades\` to the start of the class namespace.

For example, for using facade for the `app\models\LoginForm` class, just import `facades\app\models\LoginForm` class

### 🔷 Utilizing Facades

Just call the desired method statically & enjoy :)

##### For components:
`Request::get('foo')` is equal to `Yii::$app->request->get('foo')`

##### For other classes

`LoginForm::rules()`

is equal to

`$loginForm = new LoginForm();`

`$loginForm->rules()`

## 🟡 More Examples

### 🔷 Facades for Yii2 Components

#### 🔸 Generate random string

##### before
`$random = Yii::$app->security->generateRandomString(128);`
##### after
import: `use facades\Security;`

`$random = Security::generateRandomString(128);`

#### 🔸 Add Flash to session

##### before
`Yii::$app->session->addFlash('success', 'Wow, Yii is great');`
##### after
import: `use facades\Session;`

`Session::addFlash('success', 'Wow, Yii is great');`

#### 🔸 Fetch all users

##### before
`Yii::$app->db->createCommand('SELECT * FROM user')->queryAll();`
##### after
import: `use facades\Db;`

`Db::createCommand('SELECT * FROM user')->queryAll();`

#### 🔸 Format currency

##### before
`Yii::$app->formatter->asCurrency(123456.78, 'USD');`
##### after
import: `use facades\Formatter;`

`Formatter::asCurrency(123456.78, 'USD');`

### 🔷 Facades for other classes

#### 🔸 Call none static methods on other classes

##### before
import: `use app\classes\Greeting;`

`$obj = new Greeting();`

`$obj->sayHello('Mr. Mahan');`

##### after
import: `use facades\app\classes\Greeting;`

`Greeting::sayHello('Mr. Mahan');`

#### 🔸 Call none static methods on a model

##### before
import: `use app\models\Post;`

`$post = new Post();`

`$titleLabel = $post->getAttributeLabel('title');`

##### after
import: `use facades\app\models\Post;`

`$titleLabel = Post::getAttributeLabel('title');`


## 🟡 Available Facades
- All components that are defined in the components array of config file, are supported.
- All Classes (including models, Yii classes, your custom classes & ...) are supported