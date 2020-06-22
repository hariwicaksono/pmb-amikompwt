import React, { Component } from 'react'
import {Link,Redirect} from 'react-router-dom'
import Navbar from './Navbar'
import Footer from './Footer'
import Appbar from './Appbar'
import SideButton from './SideButton'
import API from '../ServiceApi/Index'
import {Container, Form, Row, Col, Carousel, Button, Tabs, Tab, Alert, Card} from 'react-bootstrap'
import {BoxArrowInRight,PersonPlusFill} from 'react-bootstrap-icons'
import { Helmet } from 'react-helmet'
import Parser from 'html-react-parser'
import { NotificationManager } from 'react-notifications'
//import Soal from './Soal'
//import Pagination from 'react-js-pagination'

const TITLE = 'PMB Universitas Amikom Purwokerto'

class Home extends Component {
    
    constructor(props) {
        super(props)
        this.state = {
            username: "",
            password: "",
            level: "",
            isLogin:false,
            idLogin:""
            //Soal: []
            //activePage : 0
        }
        this.handlerChange = this.handlerChange.bind(this)
        this.handlerSubmit = this.handlerSubmit.bind(this)
    }

    handlerChange = (event) => {
        this.setState({
            [event.target.name]: event.target.value
        })
    }

    handlerSubmit = (event) => {
        event.preventDefault()
        API.PostLogin(this.state).then(res=>{
            if (res.id === "1" ) {
                sessionStorage.setItem('isLogin',JSON.stringify(res.data))
                this.setState({
                    isLogin:true,
                    idLogin:"1"
                })
                NotificationManager.success('Berhasil masuk sistem');
            } else {
                NotificationManager.warning('Login gagal, periksa username dan password anda');
            }
        })
    }
 
    //handlerChange = (pageNumber) =>{
         //console.log(pageNumber)
         //this.setState({activePage:pageNumber})
    //}

    //componentDidMount = () => {
        //API.GetSoal().then(res => {
            
            //this.setState({
               // Soal: res
               
            //})
            
        //})
    //}
    
    render() {

        if(this.state.isLogin){
            if (this.state.idLogin === "1") {
                return( <Redirect to="/user" /> )
            } 
        }

        return (
            
            <div>
                <Helmet>
                <title>{ TITLE }</title>
                </Helmet>

                <Navbar />
                
                <Container fluid>

                <Row>
                    <Col sm={5} md={4} lg={3} className="py-3" style={{backgroundColor: "#482373"}}>
                        
                    <SideButton />
                   
                    </Col>

                    <Col sm={7} md={8} lg={9}>

                    <Carousel className="mb-3">
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src="http://pmb.amikompurwokerto.ac.id/files/cover.jpg"
                            alt="First slide"
                            />
                            
                        </Carousel.Item>
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src="http://pmb.amikompurwokerto.ac.id/files/3.jpeg"
                            alt="Third slide"
                            />

                           
                        </Carousel.Item>
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src="http://pmb.amikompurwokerto.ac.id/files/2.png"
                            alt="Third slide"
                            />

                            
                        </Carousel.Item>
                        <Carousel.Item>
                            <img
                            className="d-block w-100"
                            src="http://pmb.amikompurwokerto.ac.id/files/4.png"
                            alt="Third slide"
                            />

                            
                        </Carousel.Item>
                    </Carousel>
                    
                    <Container className="bg-white py-3">
                    <Row>
                    <Col md={9} lg={10} className="border-right">
                    <Form onSubmit={this.handlerSubmit}>
                    <Card className="py-0">
                    <Card.Body>
                    <h5>Login</h5>
                        <Form.Row>
                            
                            <Form.Group as={Col} sm="12" md="4" lg="4" controlId="formBasicUsername">
                                <Form.Control type="text" name="username" placeholder="Username" onChange={this.handlerChange}/>
                            </Form.Group>
                            
                            <Form.Group as={Col} sm="12" md="4" lg="4" controlId="formBasicPassword">
                                <Form.Control type="password" name="password" placeholder="Password" onChange={this.handlerChange}/>                       
                            </Form.Group>
                            
                            <Form.Group as={Col} sm="12" md="4" lg="2" controlId="exampleForm.ControlSelect1">
                                    <Form.Control as="select" name="level" onChange={this.handlerChange}>
                                    <option>Pilih</option>
                                        <option>USER</option>
                                        <option>ADMIN</option>
                                    </Form.Control>
                            </Form.Group>
                            
                        <Form.Group as={Col} sm="12" md="12" lg="2">
                            <Button variant="primary" type="submit" onSubmit={this.handlerSubmit} block>
                            Masuk
                            </Button>
                        </Form.Group>
                        
                        </Form.Row>
                        
                        </Card.Body>
                        </Card>
                    </Form>
                    </Col>

                    <Col md={3} lg={2}>
                    <Card as={Link} to='/register' bg="light" text="dark" className="text-center">
                    <Card.Body>
                        <Card.Text style={{color:"#482373"}}><PersonPlusFill size={30} /><br/>Daftar Akun Baru</Card.Text>
                    </Card.Body>
                    </Card> 
                    </Col>
                    </Row>
                    </Container>

                    </Col>
                    
                </Row>
                </Container>    

                {/*<Soal data={this.state.Soal} />*/
                }

                {/* <Pagination
                    itemClass="page-item"
                    linkClass="page-link"
                    activePage = {this.state.activePage}
                    itemsCountPerPage = {1}
                    totalItemsCount ={10}
                    pageRangeDisplayed = {3}
                    onChange = {this.handlerChange.bind(this)}
                /> */}
               
           
            <Footer />   
            <Appbar />
            </div>
        )
    }
}

export default Home