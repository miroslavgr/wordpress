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

Every component which Will only have a render method , can be transformed into function Component
Function Component is a normal function with name as should be the Component and paramaetrs (props) 
and this function returns what the render should return , Then this function name becomes executable as a React Object
Just like the Component itself

function Square(props) {
	return (<button className="square" onClick={props.onClick}>
      {props.value}
    </button>);
}
          

          
  
