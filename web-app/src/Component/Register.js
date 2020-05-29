import React, { Component } from 'react'
import {Link} from 'react-router-dom'
import Navbar from './Navbar'
import Footer from './Footer'
import Appbar from './Appbar'
import API from '../ServiceApi/Index'
import { Helmet } from 'react-helmet'
import { NotificationManager } from 'react-notifications'
import {Container, FormLabel, FormGroup, FormControl, Row, Col, Button} from 'react-bootstrap'
import Form from 'react-formal'
import * as yup from 'yup'

const TITLE = ' Daftar - PMB Universitas Amikom Purwokerto'

const schema = yup.object({
    nama: yup.string().required(),
    telp: yup.number().required(),
    email: yup.string().required(),
    username: yup.string().required(),
    password: yup.string().required(),
  });
class Register extends Component {
    constructor(props){
        super(props)
        this.state = {
            nama:"",
            telp:"",
            email:"",
            username:"",
            password:"",
            //foto:"user.jpg",
            err:""
        }
        this.handlerChange = this.handlerChange.bind(this)
        this.handlerSubmit = this.handlerSubmit.bind(this)
    }

    handlerChange = (event) => {
       this.setState({
           [event.target.name] : event.target.value
       })
    }

    handlerSubmit = (event) => {
        event.preventDefault()
        //console.log(event)
        API.PostUser(this.state).then(res=>{
            console.log(res)
            if (res.status === 1 ) {
                this.props.history.push('/login')
            } else {
                this.setState({
                    err:"GAGAL REGISTER"
                })
            }
        })
    }


    render() {
    return (
    <div>
    <Helmet>
    <title>{ TITLE }</title>
    </Helmet>
    <Navbar />
    <Container className="my-4" fluid>
        <Row>
        <Col md={8}>
            <div className="card">
                <div className="card card-default">
                    <div className="card-body">
                        <h3>Daftar Akun <small>PMB Universitas AMIKOM Purwokerto</small></h3>
                        <hr/>
                     
                        <Form onSubmit={this.handlerSubmit} schema={schema} >

                            <FormGroup controlId="field--nama">
                           
                            <FormLabel>Nama Lengkap*</FormLabel>
                                
                                    <Form.Field className="form-control" placeholder="Username"
                                    name="nama"
                                    onChange={this.handlerChange} />
                                    <Form.Message for="nama" className="error" />
                                   
                            </FormGroup>

                            <Row>
                            <FormGroup as={Col} controlId="field--email">
                                <FormLabel>Email*</FormLabel>
                                <Form.Field type="text" placeholder="Email" name="email" className="form-control" onChange={this.handlerChange}/>
                                <Form.Message for="email" className="error" />
                            </FormGroup>
                            
                            
                            <FormGroup as={Col}>
                                <FormLabel>Telp/HP*</FormLabel>
                                <Form.Field type="text" placeholder="Telp/No.HP" name="telp" className="form-control" onChange={this.handlerChange} />
                                <Form.Message for="telp" className="error" />
                            </FormGroup>
                            </Row>

                            <FormGroup>
                                <FormLabel>Username*</FormLabel>
                                <Form.Field type="text" placeholder="Username" name="username" className="form-control" onChange={this.handlerChange} />
                                <Form.Message for="username" className="error" />
                            </FormGroup>
                            <FormGroup>
                                <FormLabel>Password*</FormLabel>
                                <Form.Field type="password" placeholder="Password" name="password" className="form-control" onChange={this.handlerChange} />
                                <Form.Message for="password" className="error" />
                            </FormGroup>

                            <Form.Submit type="submit" className="btn btn-primary">Submit</Form.Submit>
                        </Form>
                     
                       
                    </div>
                </div>
            </div>
        </Col>
        
        <Col md={4}>


        </Col>
        

        </Row>
    </Container>
    <Footer />
    <Appbar />
    </div>
    )
    }
}


export default Register