import React,{Component} from 'react'
import {Link,Redirect,NavLink } from 'react-router-dom'
import { Container, Row, Col, Navbar, Nav, Button} from 'react-bootstrap'

class Footer extends Component{
    render(){
     
        return(  
            
            <div style={{backgroundColor:'#110D56',marginTop:'14px'}} className="pt-5 pb-5">
            <Container>
            <Row>
                <Col sm={6} md={6}>
                <div className="text-light">
                <h4>Contact<br/>
                <small className="text-light">Jl. Let. Jend. Pol. Soemarto (depan SPN) Purwokerto<br/>
                Telp: (0281) 623321 / (fax) (0281) 623196<br/>
                Email: amikom@amikompurwokerto.ac.id<br/>
                Whatsapp: 085848888445</small></h4>
                </div>
                </Col>

                <Col sm={6} md={6}>

                </Col>
            </Row>

            <div className="text-light mt-3">© 2020. Universitas Amikom Purwokerto</div>

            </Container>
              
        </div>
        )
    }
}

export default Footer