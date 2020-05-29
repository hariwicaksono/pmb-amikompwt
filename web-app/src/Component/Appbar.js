import React,{Component} from 'react'
import {Link,Redirect,NavLink} from 'react-router-dom'
import { Container, Row, Col, Navbar, Nav, NavItem, Button} from 'react-bootstrap'
import { HouseDoor, Grid, BoxArrowInRight, PersonPlus } from 'react-bootstrap-icons'

class Appbar extends Component{

    render(){
        if (sessionStorage.getItem('isLogin')) {
            return(<Redirect to="/user" />)
        }
        if (sessionStorage.getItem('isAdmin')) {
            return(<Redirect to="/admin" />)
        }
        
        return(
            <div className="pt-4 mt-4">
              
              
              <Navbar bg="light" fixed="bottom" sticky="bottom" style={{height:'60px'}}>
              
              <Nav className="mx-auto text-center">

              <NavItem className="navItem">
                <NavLink className="nav-link" to="/" activeClassName="active" exact><HouseDoor size="20"/><br/>Home</NavLink>
              </NavItem>
              <NavItem className="navItem">
                <NavLink className="nav-link" to="/about" activeClassName="active"><Grid size="24"/><br/>Panduan</NavLink>
              </NavItem>
              <NavItem className="navItem">
                <NavLink className="nav-link" to="/register" activeClassName="active"><PersonPlus size="20"/><br/>Daftar</NavLink>
              </NavItem>
              <NavItem className="navItem">
                <NavLink className="nav-link" to="/login" activeClassName="active"><BoxArrowInRight size="20"/><br/>Login</NavLink>
              </NavItem>

                </Nav>
           
        
          
            </Navbar>
       
        
        </div>
        )
    }
}

export default Appbar