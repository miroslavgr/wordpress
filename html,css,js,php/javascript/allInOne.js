/*
Installs needed

IDE - vs code - install EsLint, jsbeutify
node.js - nvm - node version manager
nvm uses v8 engine which chrome use it too(engines translate to native code)
every browser used to have different engine and that was a problem, but nowadays they are fairly same.

Story of javascript
First html was create for simple information information after that animations and pictures are created
and after that javascript(livesciprt then) is created by Netscape.
It takes the syntaxys from java.The first language that was intended to work in the browser was java but they failed.
After that Javascript is created and implemented in 10 days by Netscape company(a group of young people).
When sun(java) decided to work together with netscape(livescript)
to kill microsoft, they both decided to name it javascript and trademarked it
as ecmascript. Netscape and Microsoft go into browser wars. They both created browsers.
Microsoft creates ajax but doesnt realize its potential and by the end of the day they actually helped javascript
because without AJAX a big complex website is a nightmare to the user.


Overview of javascript

github.com/airbnb/javascript - code guidelines for good practices

There are 2 types of programming languages - static and dinamyc.

static languages - explicit type declration of variables - strongly typed.
Type checking occurs at compile-time. They compilers to convert the language code to machine code.
compiler (c,c++) -> cpu , compiler(c#,java)-> intermediate code for VM.

dynamyc(scripting) languages - implicit type declaration of variables - weakly typed.
Type checking occurs at run-time.They do not have compilers like static languages
 and the compilation is done line by line.
Instead interpter and JIT are used.Dinamyc languages are slower than static languages because of that.
interpreter(php,js)->executes a script line by line (no compilation)
JIT(just-in time compiler) compiles to native code(cpu) at run time
Interpreted - Jit compiled

There are no classes in javascript like other languages but javascript is first class functional language. 
Which means function can be assigned, passed as arguments,returning functions and act like variables.

There is no overloading in javascript but it can be simulated with arguments[]

Declaration of variables is made with keywords var/let/const or global(no keyword)
Var and globals were the only way to declare variables before year but after that 
let and const were invented. Let and const are preffered for only use nowadays because of scope reasons.

Scope of global variables - everywhere in the whole app.This itself leads to alot of trouble and is no need
to comment this any further. You should not use it never,if you dont want to mess up your whole app.
var a=5;
Scope of var variables - function scope and anywhere further (including function definitions inside)
but no outside of the functions. if its used before a line where its declared it goes undefined type.
If its defined in further scopes of Loops its still accesible outside these scopes until its the same function.

let a=5; const a=5;
Scope of let/const -block scope and anywhere further(including funcs). If it is used before the line its declared
an 'Reference error: variable is not defined' is produced. Const is the same as let but its immutable

Good practices of declaring variables
Never use global variables.Stop using var too and go into let and const.
Declare all variables which may be used at the beginning of the function.

';' makes the line execute. Always write it.
{} - scope brackets
1.the opening bracket always on the same line
2.else if and else on the same line as the closing bracket of the last statement.

As we said var/let/const are used to create variables,but these variables have types. Primitive types and Objects.
All primitve type values are given by value and all Object type variables are given by reference.
typeof(); -return type of a variable
There are 6 primitive types
1. number - real numbers and floating points numbers are combined in one type which actually is 64bit floating point.
2. string - strings in javascript are immutable. Which means every time you try to make some kind of change you mostly will
make a copy, but cant change it. "" and '' are the same but with `${a}` cant put variables in the string like "" in php
3. boolean - true/false are used without ""
4. null - a variable which is defined and has value null. 
5. undefined - a variable which is not defined
6. Symbol

Object type - everything except primitive types, though strings and arrays are kind of objects.
In objects key names never use '-' because json can be confused.

All values are has Truth like or False like value itself.
There are 6 values which False like
1.null
2.undefined
3.'' , ""
4.0
5.NaN
6.false

Truth like values - all other
1. all numbers except 0
2. all strings except empty string
3. all objects
4. true

NaN -(Not a Number) is not primitve type or object. It is of type number.
If try to do operations on it, will not give error but it stays NaN 
forever until we reassign some variable on it.

*/

//concatenation - '+' is used. Checking all types and if there is string everthing goes string

/*string operations
strings are immutable they areare like arrays and arrays are objects. "" or '' there is no difference choose for yourself which one to use
*/
let str = "hello";
str.length;//return length
str[0];// can get but if try to set nothing will happen because strings are immutable
str[10];//return undefined because this index is not declared
arr = str.split(" ");//string to array by delimiter
str = str.join(" ");//array to string by delimiter
str.indexOf("am");//return the starting index or if doesnt find nothing return -1
str.lastIndexOf('m');//returns the last where found
str.substr(5,2);// return str(start,length)
str.substring(5,9);//(start,end)
str.replace("e","w");//replace the first with second but only the first found
str.replace(/e/g,"w");//replace all with regex(global flag exist)
str.charAt(3);//get char char by index
str.toLocaleLowerCase(str);// return string to lower
str.toUpperCase(str);//return string to upper 
str.slice(0);//make a copy of the string
str.charCodeAt(0);//get ascii code by index
String.fromCharCode(97,98,99);//make string from ascii
str.startsWith("as");//true/false if starts with argument
//we cant reverse a string because its immutable so we make an array from the string and reverse it
let arr =Array.from(str); //return a array of string
arr.reverse().join("");//get the reversed string

/*array operations
arrays in javascript can have anything on any index - which is same capabilited like php
They are not real arreys but they are objects. In some situations they dont act like real arrays
for example arr[-2]="Pesho" is valied. the length of an array is all positive indexes sum.
*/
let arr = [];//the one and only good way of creating array
arr.length;//return length
arr.push(5);//add at the end by reference
arr.pop();//removes at the end and returns the deleted element
arr.shift();//deletes the first elem and return it
arr.unshift(3);//add at the begining
//arrays in js are dynamic which means this is valid
arrp[199]=5;// and the length is 200 now
let newrr =arr1.concat(arr);//merge the arrays and return it
let string = arr.join(" ");//return a string of the array elements
arr.reverse();//reverse elements by reference
let newarr = arr.slice(1,3);// return an array from index to index
//change old array by reference
arr.splice(1,2,"optional");//return newarray. first param-start index second param - length, 3rd param -params to insert on its place
//copy array fastest and easiest way 
let copy = arr.slice(0);//from index 0 to maximum
arr.indexOf("elem");//searches array for an element and return the first found's index if element doesnt exist return -1
arr.lastIndexOf("elem");//same but return the last found elem
arr.includes("elem");//return true or false if an element is there or not
//in javascript array are objects
let arr ={//the same as below
    "pesho":3
}
arr["pesho"]=5; // the same
//sorting for ascending
arr.sort((a,b)=>{
return a-b; 	
});
let localString = JSON.stringify(arr);//object to string and return the JSON string
let againObj = JSON.parse(localString);//JSON string too object and return it

//Casting operations examples

//string to number
let str = '5'; // 5 type string
let num = +str; // 5 type number
//string/number to float/int
Number.parseInt();
Number.parseFloat();

//loops - break and continue work as expected
//all the standard loops in javascript are not very used because there is a better and more practical way to do it
//for loop
for(let i=0; i<=5;i++){

}
//special for loop - by key, never use it because the executaion may not start ordered
// so it exists but never use it
let nums = [5,10,6,22,'asd'];
for (let index in nums){

}
//for..of - by value, same never use it
for(let value of nums){

}
//while
while(true){

}

//switch - its not prefered to use in javascript, because its very slow and sometimes
// doesnt work as uxpected
let a=3;
switch(day){
	case 1: break;
	case 2: break;
	default: break;
}

//the good and practical way to use loops is with different functions

//foreach is called for every element of the array.
//In practice its used alot.
arr.forEach((item)=>{ 
    console.log(item);
});

//filter() iterates the array and makes new array of the returned true elements
let newArr = rakia.filter((val)=>{ 
	return val=="husky";
});

//find() itereates the array and return the first true element
arr.find((val)=>{
    return val=="value";
});

/*map() is invoked to take the original array and make a copy of it
This is a good way to make pure function, because you will work on the copy of the original
And making a whole example in real life
*/
let newArr = arr.map((val)=>{
    return val.toLowerCase();
})
.filter()
.reduce((sum,elem) => {// reduce is used to have a single variable and make something with every element with it
 sum+=elem;
},10); // second param is given as default value of the accumulator



/*objects 
objects are set of key:value pairs
use "" for keys when operating with json
never use - in key names
like structures in C , map in java
*/
let person = {
	x: 5, // key/property - x , value - 5
	y: -2
}
typeof(person);//return object

let person = {
	"x": 5, // not required to use "" for keys but when working with json its required
	'y': -2
}
person.length;//length of the object
person.x;//get the value - 5, getting a property
person["x"];//second way
person.name = "example";//add a property
person["name"] = "example";//add second way
delete person.name;// exist but never use it because its very slow and old
person.name=null;// set to null is better practice
if(person.name)//null is falsy value 

let keys = Object.keys(person);//return array of keys //never expect ordered indexes
let values = Object.values(person);//return array of values

Object.freeze(person);//freeze the object forever becomes read only
Object.isFrozen(person);

Object.seal(person);//light form of freeze - can change properties but cant add property
person.x=5;//valid
person.newProp=10;//invalid
Object.isSealed(person);

//how to copy a object -> object to string and string to object with JSON

for(let item in person){
	item;//key
}
Object.keys(person).forEach((key)=>{
	person[key];//values
})

//json -javascript object notation
//cant put functions in them, if we put a function it will be ignored and not added
/*{
	"firstName": "Pesho",
	"age": 10
}*/
let localString = JSON.stringify(arr);//object to string and return the JSON string
let againObj = JSON.parse(localString);//JSON string to object and return it

let info = require("./info.json");

//maps and sets
let test = new Map(); //completely uselesssly complex
test.set("firstName","Pesho");
test.get("firstName");
test.delete("firstName");

let test = new Set();// again useless




/*
operations - all opeartins needed are in Math object
always use === for checking type and values
*/
1=='1'//true, dont use it because it does not check the type
1==="1"//false this checkes and types which is the best practice now
1>'2'// this and => does not check the type like === but there is no alternative

let a= 1 && 2 && 3;//return the last if all truthy/ if any is falsy return the falsy and stop
let a= 1 || 2 || 3;//return the first truthy/if all falsy return the last falsy

!!a;//return if a variable is truthy or falsy like to true and false
//if()// uses !! to convert all variables to true or false

Math.floor(7/3);// 2 rounds on the below
Math.ceil(7/3);// 3 rounds on the upper
Number.isInteger();//return true if a value is integer


/*functions - named piece of code -camelCase use, when are classes start with capital character
in Javascript there are 2 types of functions pure and not.
pure function
1- same arguemnts => same result;
2- no influance on other things
every function must return something to be pure

impure functions - all other

Always try to use pure functions. That will decrease your risk of a mess in a bigger code.
*/

//pure function example
let arr = [];
function run(a,b){
   return a+b; // always the same result, no influence on outside variables
}
//impure function example
let arr = [];
function run(b){ // impure function
	arr[0]="Pesho"+b; // have influnce on outside array which automatically makes it impure
   return arr[0]; // returning different results which also makes it impure
}
//3 ways to declare a function
//1 function declaration - hoisting is done and you can run a function before its declared but not a good practice
function run(){
}

//2 function expression - name the function for better debugging or make it anonymous - better practice than declaration
let running = function run(b){
	b = b || 10; // if b is false like set it to 10
}
running(5);

//3 lambda/arrow functions
let running = () =>{

}

//function callback
function run(legs,walk){
    if(legs===2){
        walk();
    }
}
let walk = function(){
    console.log();
}
run(2,walk);

//nested functions
function run(){
    function tired(){
        let rest = function rest(){
			
		};
		return rest; // return a function
    };
   
}

//immediately invoking function/self invoking function
//capsulating all variables in its scope and its very usefil for web apps
(function run(a,b){
    console.log();
})(10,20);

// arguments - never try to edit elements in it
function run(b){
    for(i=0;i<arguments.length;i++){
		arguments[i];
	}
	b = b || 10; // check for false like values. Validating a variable
}

/*regex
regex101.com
flags - global - match all
*/
let regex="/[0-9]";
regex.test("String");// true or false
"t ex t".match(regex);// return array of splitted string

//DOM and BOM
/*
IIFE - imediately invoked function  to encapsulate everything
classes in javascript are sugar syntaxis which means are functions

DOM is in BOM
BOM- browser object model is the whole browser
DOM is part of BOM
everything in DOM is by reference
*/


/*Advanced javascript */
let interval = setInterval(func,miliseconds);
clearInterval(interval);//stop
setTimeout(func,miliseconds);

//some functions get by reference, some do it as a query like a snapshot

//innerHTML removes and changes the text between tag (parsing real html)
//textContent same but escapes tages and make it all text(parsing text only)
//.addEventListener("click", addItem);//event and function
//.removeEventListener("click", addItem);

let elem = document.createElement("li");
appenchChild(elem);

//classes are used too for selecting many elements and performing 
//event listener on them

let interval = setInterval(func,miliseconds);//call the func in interval time
clearInterval(interval);//stop
setTimeout(func,miliseconds);//call function only once
//set timeout is goes at the lowest of our event loop

//some functions get by reference, some do it as a query like a snapshot

/*innerHTML removes and changes the text between tag (parsing real html)
textContent same but escapes tages and make it all text(parsing text only)
.addEventListener("click", addItem);//event and function
.removeEventListener("click", addItem);
classes are used too for selecting many elements and performing 
event listener on them
*/
let elem = document.createElement("li");
appenchChild(elem);

//jquery
$('div');// get by tag name
$('.className');//get by class name
$('$idName');//get by id
$('ul.menu li');// get all li from ul with class menu
$('div').css('background','blue');// apply to all elements
$('li:even');//all even
/* odd
    first
    last
    first-child
    has(p) - all li which has p tags inside
    contains("Sofia") - all li containing Sofia string

*/
$0; // returns the current selected element in browser
$() == jQuery()
//all functions are used for both getters and setters
$("#wrapper div").append("<p> this is added</p>");

$("#createLink").on("click",(e)=>{
    e.preventDefault();// stops the furthers actions of the element
    e.stopPropagation();//the click is not being triggered in the upper elements
    // like try catch and stops the exception in the current clicked element
    //always use these both functions for event listeners

    e.stopImmidatePropagation(); // more strict if doesnt work

});
$("#createLink").on("click","а",(e)=>{}); // delegate - all now and future a tags 
// will have this event
