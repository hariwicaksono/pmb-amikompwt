import React, { Component } from 'react'
import {Link} from 'react-router-dom'
import Navbar from './Navbar'
import Footer from './Footer'
import Appbar from './Appbar'
import API from '../ServiceApi/Index'
import { Helmet } from 'react-helmet'
import { NotificationManager } from 'react-notifications'
import {Container, FormLabel, FormGroup, Row, Col} from 'react-bootstrap'
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
const schemaLog = yup.object({
    username: yup.string().required(),
    password: yup.string().required(),
    level: yup.string().required(),
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
    <div className="bg-white mx-3">
    <Container className="my-3 px-3 py-4" fluid>
        <Row>
        <Col md={8}>
            <div className="card">
                <div className="card card-default">
                    <div className="card-body">
                        <h4 className="mb-3">Daftar Akun <small>PMB Universitas AMIKOM Purwokerto</small></h4>
                     
                        <Form onSubmit={this.handlerSubmit} schema={schema} >

                            <FormGroup>
                           
                            <FormLabel>Nama Lengkap*</FormLabel>
                                
                                    <Form.Field className="form-control" placeholder="Username"
                                    name="nama"
                                    onChange={this.handlerChange} />
                                    <Form.Message for="nama" className="error" />
                                   
                            </FormGroup>

                            <Row>
                            <FormGroup as={Col}>
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

                            <Form.Submit type="submit" className="btn btn-primary">Daftar</Form.Submit>
                        </Form>
                     
                       
                    </div>
                </div>
            </div>
        </Col>
        
        <Col md={4}>
        
        <div className="card">
                <div className="card card-default">
                    <div className="card-body">
                    <h4 className="mb-3">Login</h4>
        <Form onSubmit={this.handlerSubmit} schema={schemaLog}>
            <FormGroup>
                <FormLabel>Username</FormLabel>
                <Form.Field type="text" name="username" placeholder="Username" className="form-control" onChange={this.handlerChange} />
                <Form.Message for="username" className="error" />
            </FormGroup>
            <FormGroup>
                <FormLabel>Password</FormLabel>
                <Form.Field type="password" name="password" placeholder="Password" className="form-control" onChange={this.handlerChange} />
                <Form.Message for="password" className="error" />
            </FormGroup>
            <FormGroup>
            <Form.Field as="select" name="level" className="form-control" onChange={this.handlerChange} >
                    <option value={null}>Pilih</option>
                    <option>USER</option>
                    <option>ADMIN</option>
            </Form.Field>
            <Form.Message for="level" className="error" />
            </FormGroup>
            <Form.Submit type="submit" className="btn btn-primary">Masuk</Form.Submit>
        </Form>
        </div>
        </div>
        </div> 

        </Col>
        

        </Row>
    </Container>
    </div>
    <Footer />
    <Appbar />
    </div>
    )
    }
}


export default Register