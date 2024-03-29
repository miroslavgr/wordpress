



1. /* Overall architecture */




2. /*Components */
A component is class which extends React.Component
Every component has a render method which returns an React Object
Every React Object is being compiled to javascript and html
Every defined Component becomes like a html tag which executes the Component's render method

Components can have Props and State
State values are defined in the contrusctor of each Component

//next they are accesed like this anywhere in the class
this.state.stateVal

Props are given properties by parent 
For example we have Square component
It is called like this <Square /> 
Props are like attributes in html tags like this <Square propVal={1}/>
If any parent calls Square with any kind of attributes, 
Square can execute these attributes with 
this.props.propVal anywhere in the component

Props can be default if non are provided

Header.defaultProps = { title: "Task Tracker"};

Also props can have types ( strin, int, func etc )
Header.propTypes

Every component which Will only have a render method , can be transformed into function Component
Function Component is a normal function with name as should be the Component and paramaetrs (props) 
and this function returns what the render should return , Then this function name becomes executable as a React Object
Just like the Component itself

function Square(props) {
	return (<button className="square" onClick={props.onClick}>
      {props.value}
    </button>);
}
		
3.
 
Hooks - used only in function components, never in class component
		they all must be only at top level in the funcittion and will be executed in the same order as declared
		
useState - creates state variable and a settor method - parameter is the default value
	its possible the setter method to call the previous value for more safity
const [tasks, setTasks] = useState(defaultvalue)
	
useEffect() - (function, variable) - everytime the variable is changed, trigger the function
useEffect (() => { }, [variable])

if second param is not provided - it will be executed on every render
if second param is [] - it will be called only on mount ( first render )
return in useEffect is like a cleaner before the prior code is executed ( for example removeevent before add it again )
	

useMemo(function, variable) - this will cache the results of the functions and will re-execute the function only if variable is changed
- its used for caching slow functions, dont use it everywhere

Also its used to memoriaze the real const objects as adresses, for example we have useEffect which executes on "products" change
but products is defined as const products = state.products, use effect will be called on every page render because we are defining
new object with new adress, for that reason is used useMemo to cache the same objects

useMemo: Returns and stores the calculated value of a function in a variable
useMemo returns the variable result from the function
	
useCallBack: Returns and stores the actual function itself in a variable
useCallBack returns the function executable as function
Just use it to create functions only when they depend on the change of some state

useRef(value) - Very similar to state but does not cause any renders 
ALso second use case is for focusing inputs or things like this ( check video )
Or used to store previous value of state
	It just persists values between renders
Its like a shadow without causing re-render

const createdContext = createContext("my-cars");
const valueContext = useContaxt(createdContext) - useContext is used to get the state value of a particular context
	
	
useReducer - Its the same as state but here is the deal:
IF we have a state which will be modiied in many different ways from events
( add, delete , toggle, the state array items ) - we have to create different functions for
every different action, and with reducer we can use only 1 function, providing what action we want to do
after that with switch case perform the action,
That way we can achieve the state variable changes in only 1 function and have overall better visibility and control of the operations for this state
MORE IMPORTANTLY in my case if mini my cars i had only 1 component, but if there are nested components we can just pass dispatch and
children will call it with the correct action, in case of state this becomes very complex



          Basics

  React app files structure
	
package.json - contains all the dependencies and scripts ( commands )for the project
for example start in single react app launches react-scripts-start
and start in woocommerce plugin compiles the code run time\
	
// basically we get the javascript object element with vanilla javascript , and render it with a specific component in the reactDOM
ReactDOM.render( <App/> , document.getElementById("#root"));
	
		
		
		
		
		
		
		
		
		
/* 
	History and description
	React is open source javascript library used for bulding UI.

*/		
		
  
