/*Component */
A component is class which extends React.Component
Every component has a render method which returns an React Object
Every React Object is being compiled to javascript and html
Every defined Component becomes like a html tag which executes the Component's render method

Components can have Props and State
State values are defined in the contrusctor of each Component

constructor(props){
  super(props);
  this.state = {
    stateVal: 5,
  }
}

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

useRef(value) - Very similar to state but does not cause any renders 
ALso second use case is for focusing inputs or things like this ( check video )
Or used to store previous value of state
	It just persists values between renders
Its like a shadow without causing re-render

          

          
  
