import React, { Component } from 'react'
import {Link,Redirect} from 'react-router-dom'
import Navbar from './Navbar'
import Footer from './Footer'
import Footbar from './Footbar'
import NavButton from './layout/NavButton'
import API from '../ServiceApi/Index'
import {Container, Form, Row, Col, Carousel, Button, Tabs, Tab, Alert} from 'react-bootstrap'
import {BoxArrowInRight} from 'react-bootstrap-icons'
import { Helmet } from 'react-helmet'
import Parser from 'html-react-parser'
import Loader from 'react-loader'
import { NotificationManager } from 'react-notifications'
//import Soal from './Soal'
//import Pagination from 'react-js-pagination'

const TITLE = 'PMB Universitas Amikom Purwokerto'
var options = {
    lines: 13,
    length: 20,
    width: 10,
    radius: 30,
    scale: 0.35,
    corners: 1,
    color: '#fff',
    opacity: 0.25,
    rotate: 0,
    direction: 1,
    speed: 1,
    trail: 60,
    fps: 20,
    zIndex: 2e9,
    top: '50%',
    left: '50%',
    shadow: false,
    hwaccel: false,
    position: 'absolute'
};
class Home extends Component {
    
    constructor(props) {
        super(props)
        this.state = {
            username: "",
            password: "",
            level: "",
            isLogin:false,
            idLogin:"",
            gagalLogin : "",
            loading: true
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
            } else {
                NotificationManager.warning('Login gagal, periksa username dan password anda', 'Perhatian!');
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
                    <Col sm={4} md={3}>
                        
                    <NavButton />
                  
                    </Col>
                    <Col sm={8} md={9}>

                    <Carousel>
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

                    <Container className="my-3">
                        <Tabs variant="tabs" defaultActiveKey="home" className="h5">
                        <Tab eventKey="home" title="Masuk">
                            
                            <Form onSubmit={this.handlerSubmit} className="my-3 mx-1 col-md-6">
                            <Form.Label className="h6">Masuk Calon Mahasiswa:</Form.Label>
                            
                           
                            <Form.Group controlId="formBasicUsername">
                                <Form.Control type="text" name="username" placeholder="Username anda" onChange={this.handlerChange} />
                            </Form.Group>

                            <Form.Group controlId="formBasicPassword">
                                <Form.Control type="password" name="password" placeholder="Password anda" onChange={this.handlerChange} />                       
                            </Form.Group>

                            <Form.Group controlId="exampleForm.ControlSelect1">
                                    <Form.Control as="select" name="level" onChange={this.handlerChange}>
                                        <option>--Pilih Level--</option>
                                        <option>USER</option>
                                        <option>ADMIN</option>
                                    </Form.Control>

                            </Form.Group>

                            <Form.Group>
                            <Button variant="primary" type="submit" onSubmit={this.handlerSubmit}>
                            <BoxArrowInRight/> Masuk
                            </Button>
                            </Form.Group>
                            </Form>
                           
                                
                        </Tab>
                        <Tab eventKey="profile" title="Daftar">
                            
                        </Tab>
  
                        </Tabs>
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
               
           
            <Footer/>   
            <Footbar />
            </div>
        )
    }
}

export default Home