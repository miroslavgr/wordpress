<?php
/* LECTURE 1 INTROUCTION PHP
good site for testing -sandbox.onlinephpfunctions.com
*/

//6 types - integer, floating point, string,boolean,null,object
$a = 5; //int
$a = 5.3; //double
$a = 'string';//string
$bool = true; // 1/nothing  boolean
$thisisNUll= null; // NULL
$rock = new Rock(); // object

chr(99);//ascii to char

/*"" or '' main difference is tht in '' everything is string
and in "$a" takes the value of $a not like string \ for escaping
"\"$a\"" */
$doubleQuota = "this is int $a"; // with '' cant do this

//string operations
strlength($str); //return length
strcmp($str1,$str2);//return 0 if equal
strpos("this is me", "me"); //return the index if found -8

//trim-remove white spaces from beginning and end
$cleaned = trim("   this is trim     "); // = this is trim

//difference between == and === is that === is checkeing and types
'1'==1; // true
'1'===1; // false

//echo - can print only strings not arrays
echo $a; 

//var_dump can print and arrays
var_dump(); //better for debug tells type and more

gettype($a);


//LECTURE 2-arrays and datastructures

/*arrays
reference - http://php.net/manual/en/ref.array.php

arrays in php are not immutable and each element can be edited
3 ways to declare

* associative arrays are completely the same but
the keys can be strings

SUMMARY 
Arrays are easy to use and fast but its very hard to test
because you have to check everything. In real case Objects are used
and arrays are used only to make a list of objects. Thats how you have
checked array, because everything inside it is Object and it is checked
*/

//PHP_EOL - end of life

$arr = []; //clean array
$arr = array();//clean array

$arr = array('pesho',1,null); // 1st way to declare

$arr = array(1=>'Pesho', 2=>1, 3=>null); //2nd way
$assocArr = array('fname'=>'Ivan','lname'=>'ivanov','city'=>'Sofia');// associative  array declare

$arr = ['Ivan',1,null]; //3rd way

$arr[] = 'Niki'; // adds one more element at the end

$arr[0] = 'Pesho'; // edit an element

array_push($arr,'Pesho',1,2); // 1st argument array by reference and all other args

// array_shift / array_unshift - reindex them after operation
$lastUserGet = $arr[count($arr)-1]; // get last elem
$lastUserDeleted = array_pop($arr); // delete the last element of the arr and returns it
$firstDeleteed =array_shift($arr); // delete first elem and return it and reindex arr
$firstAdd =array_unshift($arr,'Pesho'); // add in begining and reindex arr

array_splice($arr,1,2); //2nd arg starts from , 3rd arg length 4th element replace with
//no pre index
unset($arr[1]);

//sort best reference with table php.net/manual/en/array.sorting.php
asort($arr);// sort by values by alphabetic but not reindex it
arsort($arr);// like asort buy reversed

//json
json_encode($arr); // makes it json
json_decode($arr); // decode it from json 

count($arr); // length of array ==sizeof

echo gettype($arr); // array

var_dump($arr); // - most detailed print

print_r($arr); // most beautiful way to print an array

//string to array and array to string
$arr = explode(' ',"This will become array"); // split string to array by delimiter
$string = implode(', ',$arr); // makes string of array elements 

//remove value duplicates from a array
array_unique($array);
//arr is given by value not reference
$arr = array_map('intval',$arr); // iterates the array and do the function on every element

$arrKeys = array_keys($arr); // return array with values as keys

//assiciative arrays
$arr = ['fname'=>null];
array_key_exists('fname',$arr);//true - check if key exists
isset($arr['fname']);//false - check if value in this key is set

//iterate associative array
while(current($assocArr)){
    echo key($assocArr);
    next($assocArr);
}
reset($asspcArr);
//examples
for($i=0;$i < count($arr);$i++)
{
    //makes string like printf() in C
    $stringMake = sprintf('this is string:  arr[%d] of index %d',$i,$arr[$i]);
    $arr[$i];
}

//foreach is special for arrays
foreach($arr as $element){
    echo $element;
}
//like for with indexes
foreach($arr as $i => $element){
    echo "index:".$i.$element;
}

list($a,$b,$c) = $arr;//takes the arr elements and make them variables

/*lecture 3 functions, object, classes
main topic - functions

Functions - user-defined/built in
in php invoking functions is slower by architecture but there is way to fix this.?
*/

//if doesnt have default value its always reqired or will go into error
//requied params must be first always and default after that
function run($a,$b=5){
}

//pass parameters by reference //default is by value
//main way to optimize the memory usage
function run1(&$a){
$a++;//change it by reference
}
run1($a);// pass it like normal

//arguments invoke
//can not invoke with less than required but can invoke with more than required
function run2($a){
    func_num_args();//gets count
    foreach(func_get_args() as $arg){
        $arg;//each param
        
    }
}
run2(1,2,3);

function run3(...$args){ // the same as the other but it comes as array

}
/* TYPE HINTING
strongly typed syntax
only for a particular file
declare(strict_types=1);// if its declared its no compromise with safely changing type. it goes strict at max
*/
function run4(int $a, ?string $name):?string{ // ? for null can be
}
//:string is specifying the return type
run4(1,334);//if it can make the parameter to the type safely(without loose of information) it will do
run4("asd",1);//but if can it will give fatal:error
// '1' - valid '1a' not valid because information will be lost
if(!function_exists($func)){
    function run4(){
        function run5(){ // after run4 is executed it goes global
            $func = 'run4';
        }
       
    }
}// check if exists
$func = 'run4';
$func(); // call the function js like

//qustion which one is used in the practice?

//anonymous functions
//closure function -- callback function
$func = function(){
};

$func();

//closure looks like this in php
//usort is by reference
usort($arr, function($a,$b){ // function is the closure in php
    if($a<$b)
    return 0;
    return 1;
    return -1;
});

//overloading is error in php and javascript        
/*variable scope

 $_GET $_POST $_SERVER // GLOBAL VARIABLES//ARRAYS GLOBAL SCOPE

 scope definition is only in FUNCTION AND ALL OPERATIONS like if for while etc EXCEPT FUNCTIONS INSIDE
 but can make the scope to be valid in functions inside with USE keyword

 MAIN DEFINITION OF SCOPE OF $ 
 INSIDE A FUNCTION ALL VARIABLES ARE VISIBLE TO EACH OTHER. THE VISABILITY OF EACH VARIABLE IS EVERYWHERE INSIDE THE FUNCTION 
 AND NO WHERE ELSE. THE  {} SCOPE WHERE THE VARIABLE IS DEFINED DOESNT MATTER for difference of other languages. 
Also if we have other definition of functions inside our function, again only the variables inside the second function are visible 

*/
 $a =5;
$b=7;
 function test()use $b{
    echo $b;// accesable with us in function
    static $c;// create it and keeps reference to the heap and use the reference every time
     echo $a; // cannnot acces it
 }
global $a; // make it global completely but never use it

// classes can do everything that functions can and more. So classes for big webapp is preferred

/*
Classes - is the structure of something
and instance is real object
properties 

php is OOP oriented since version 5 and tryes to go like other languages

PHP is trying to invent OOP and save the old functionality which make it like spaghetti code 
but better than nothing
So i have to be very careful when i use OOP and make define my own strict way

a class should be like a black box with public interfaces tothe other and everything else encapsulated

There are visabilites of properties
public/private/protected
var==public

Classes have special methods because we can define them and they will be auto invoked by php
constructor is special func
toString is special func
set and get but dont use them because its perdpostavka of danger. Use set for throwing exception
special funcs start with __

functions does not have visability they are public forever

negative side is for simple things its too much code and memory usage

MOST IMPORTANT in php is to make simple and not complicated classes 

$this->name this is used for inside operations with variables and funcs

getters and seters are used . For booleans start with 'is' insted of get

:: are used in 2 situations
- ROCK::run() invoking a static method

no multiple inhretiance
can not inherite more than 1 class at the same time

abstract clases - cant be instanieted. To be abstract it needs at least one function which is abstract
they can only be inhretied by other classes

interfaces - functions with no body. a interface is attached to a class to provide same functions with different logic to each class
interfaces can extend interfaces too
they can have constans too
only public funtions

a function can return
*/
class Rock{
    public $height = 12; // property
    const LIMIT = 13; // constants in php are defined this way

    //because no overloading we cant make more constructors with different params
    // and can make it only one which is bad if we need different structures. better make another class
    function __construct($height){ // but can use ...$args but better use it for same type arguments only
    $this->height=$height;
        $this->fall();//can invoke functions like this
    //cant have return and no need to have
    }
    static function run($salary){ // static functions are part of the class not the objects.
        //its a function for all objects
        if($salary<0){
            throw new Exception("Salary too low"); // throw exceptions
        }
    }
    function fall():Rock{//return rock object
        $age_name="height";
        $this->$age_name;// this will work
        return $this->height; //no dollar sign of propertiees - it accept it as string
        echo self::LIMIT; // with self get it
    }


}
class RockKid extends Rock implements rockInterface{
    //inheritance
    // all extended has everything from parents + his current
    //if you have more than 3 inheritences you have architecture problems
    // all public+protected visability of parent class
    parent::__construct();// call the parent constructor
    parent::run();//call normal parent method
}
$myRock = new Rock(5); //instance the class, type is object
$myRock->fall();//with () is func
$myRock->height;// without () is property
Rock::run();//invoke static function, cannot be invoked by object

/*anonymous objects -- there is no strucutre but can add properties
its used to make an anonymous object

stdClass() is used its internal class
stdClass has no anything to do with all other classes
and cant add methods
like structure in C but only 1 instance
not use it because its anonymmous and leads to danger
*/
$c = new stdClass();
$c->age = 12;
if(class_exists($type)){
    new $type();
}

//exceptions Exception is the class which all exceptions inherit
throw new Exception("Name is too short");// exception will stop the further code of the function
//it will invoke a rollback of the function and will go to the next func in the stack. In its way of the stack
//searchs for somebody to catch it in the all stack. If nobody catch it there will be fatal error
//uncaught exception

//an exception can be caught anywhere in the stack like this
try {
// the code which can cause exception 
}catch(Exception $e){// in catch we decide what to do with the exception
    $e->get_message();
 $name = null;
}catch(PDOExcepiion $e){
    // many catch blocks with different type of exceptions can be done
}finally{// always get here if tehre is any exception thrown

}
//include and require

include('lib.php');//if cant find file error is warning -- it will continue working
include_once('lib.php');//if its included in somewhere backwords its fine so better use it !
// if was only include() will fatal error
require('lib.php');//if cant find file error is fatal -- will stop everything
//error handling in php is good nowadays if you can control it

//auto include mechanism
sp1_autoload_register();// when this is done. and cant find a CLass it searches in the same directory 
//for same fileName as the class !!! files must contain only the exact Class and nothing else
//windows is case insentivie but linux and max is case sensitive!
$a= new MyClass(); // if MyClass doesnt exist we can make a mechanism
//the mechanism requires 1file=1class , only 1 class per file and it will be included automatically


//lecture 4 HTTP and HTML basics
/*
HTTP - hyper text transfer rotocol
-text based client-server protocl for the internet
- request-response based
- for transferring web resources (HTML files,images,styles,etc)
-stateless protocl- the life time of the http is 1request - 1 response

the response is html generated file

URL - uniform resource locator

query string - id=27&lang=en 

HTTP methods - GET POSt

Header of the protocol

       path
GET /users/repos HTTP/1.1
Host: api.github.com 
Accept: --formats
Accept-language: en 

GET request by definiton does not have body, only header

POST /users/repos HTTP/1.1
header --=--
<CRLF> - new line which define the end of header and beginning of body


Response 

HTTP/1.1 200 OK - /status line of the response

Date:
Server: Apache/2.2.14  
Accept=ranges:bytes
Content-length: 84
Content-type: text/html
<CRLF> - new line to indicate end of header
<html> -/body
<p>this is respone</p>
</html>

in http 2 the tcp is all the time up , in http 1 every time a tcp is established

HTML - HyperText Markup Language - not a programming language but a computer language
- text based notation for describing
    -document structure(semantic markup)
    -document content(text+images+others)
    -formatting(presentation markup)

files are not part of html but the way invoking files is html (request response)

when files is .php its being processed by php and the return is sent as respone
when files is .html the file is being sent directly to the client , ask how really the proccess it

DocumentRoot - can be configured in httpd.conf , is it where it gets $_SERVER['DOCUMENT_ROOT']

<form> -- almost always use post method, by default is get

<input type="hidden" name="hid" value="123"> - for system needs but never for security , its in the source of html

$_REQUEST is merged arrays of POST and GET
closing ?> of php is needed only if further html down will be written

can we get the whole HTTP request 

$_SERVER[query_string] - get the query string

programming logic and visualization in one file is wrong

https:// - http secured - you can protect your posted data by crypting it

when uploading files always post

everything that we get from the front end 
htmlspcialchars($_POST[name]) - ecapses all tags to strings - do it only on the visible part of webapp
stritags() - deletes all tags

filter_var() - main function to validate strings it has already written filters like email check

submitting array in a form
<?=$x?> == </php echo $x; ?>

minimal if for getting a variable
and loops only for showing and not making logic
and only simple invoking of functions if needed

what is the best practice how much code to include in a presenting php file

we can have array of inputs
<input name="u[]" - and all inputs which has this name will be in the same array
*/

/*lecture 5 mysql
Instance -> Database -> table
types

user_id better than id

get all local sql for deployment
like _ means one % means many
rlike - search by regex

asc/desc for each column specify

aggregate==grupirane - one of the main power of relational dbs

COUNT(*) - count all rows(all columns)
COUNT(salary) - how many of this column are not null
MAX(salary) - get the max integer from a column all rows
MIN(salary) - get minimum integer
AVG(salary) = average
SUM(salary) - +=
group by department,salary - gets same dep same salary

Algorithm of sql

1.Get everything from the table
2.Remove who dont match where
3. Group the rest
4.

mixing aggregating and not aggregating columns is very dangerous
never do this

first where
second group by
order by

employes

id name department_name salary
0  Ivan dev             100
1  Miro dev             200
2  Kolio Qa             300

SELECT COUNT(*) as c from employes - return sum of all rows
group by department_name - return count of all rows with same department_name
t.e group by department_name
order by c - order by count of each department

master and slave table

mysql workbench from graphic can make sql
or reverse engineering backwards making a graphic

relationships are logical

3 types - one to one, 
one to many many to one
many to many

relationships are based ot interconnections /foreign key/primary key

towns -> countries
many            to         one
towns                       countries
id name country_id          id name 
1 sofia  1      ->          1  Bulgaria

constraint fk_towns_countries
FOREIGN KEY (country_id)
REFERENCES countries(id)

many to many is made with 3rd table
employeed_id project_id
primary key(emokiyeed_id,project_id)

can add more columns but they must be about the foreign key combination specific

one to one
cars					drivers
car_id driver_id       driver_id driver_name
1      101				101       Pesho

columns must be unique (foreign key is uniqe itself)

always start from max strict (not null)

the only available value for a constrained foreign key column which doesnt exist is null

JOINS - make a virtual join of tables only virtually its only result set
inner join - takes only the rows which ON clause is true (ima id to i v 2te tablici)

left join - takes all rows from left table and the rows who matches the ON clause

inner join==join

select e.employee_id, e.name d.name from employes as e
inner join departments as d
on e.department_id = d.department_id //use the foireign key

on USING [department_id] // same but if both columns are same name better use the other

$db = new mysqli(); //makes connection to the database
$result = $db->query(); //return result set of the SQL query
while($row = $result->fetch_row()) {// fetch row returns a row like array of columns
	$row[0];// 
}

fetch_array - return array with indexes
fetch_assoc() - return associative array with column keys

always use prepare when mixing values from front end to sql query

$id=1;
$salary=10;
$stm = $db->prepare("DELETE FROM employees WHERE id=? and salary=?");
$stm->bind_param('ii',$id,$salary); // i for interger s for string d-double
$stm->execute();


*/


/*
web operations
MVC - model view cotroller
model(data) - connection with the database CRUD
view(UI) - everything about the visialization - front end
controller - the core logic - the mid between both 

controller control the URL and do certain things
uri - unify resoirce identifator
url is specification locator of uri

footer and header are views

controllers are the files which call teh CRUD files to the database
controller/action/parameter

spl_autoload_register(function ($class_name)){
    include 'DirName/'.$class_name.'.php';
}
to include class from inner dir

namespace Eshop;// is used to uniqe the classes names by adding the string first
namespaces is only valid conception for classes

with use defining in index.php the aliases
use DB\DBConnection as DBConnection;  // alias

in classes with namespaces defining other objects must like \PDO to tell useing the global namespace not the current

$iniArray = parse_ini_file(db.ini); //associative array

create
.ini files are files only with configuration
key-value pairs which are invoked in php and have them as array
db.ini - real init
db.sample.ini - sample init for commit and show how to init

$configArr = parse_ini_file("db.ini"); // return array of ini
__FUNCTION__ - take the name of the current function like recursive

datatype class - like struct in c 
no logic only data and get and set methods only can change getters and setters 
when have to take the name of class always do it this way
ProductDTO::class
not like string

if have to use prepare alot of times use it only 1 time and do the 
binding and execute as much as want

yeld is generator . It returns pointer to th current value and the 
loop in the next function acivates it

rest services and ajax

Representational State Transfer(REST) - architecture for client-server 
communication over HTTP
Resources have URI(address)
Can be craeted/retrieved/modified/deleted etc
REST is API over HTTP
API like this is RESTful API
http://some-service.org/api/posts/17
this called with different http methods do different thing
GET - return list of posts or a post
POST - create new post
DELETE - delete the post
PUT/PATCH = update the post
POSTMAN software application to make different 
http methods methods to resources because
with browser can do only get

witch curl library in php we can make http to the RESTFUL APIs
*/
$ch = curl_init();
curl_setopt($ch, CURLOP_URL, "http://softuni.bg");
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);
echo json_decode($results);//return array of json objects

curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data)); // object to json
//json is 10x times lighter than xml because has no tags


?>
