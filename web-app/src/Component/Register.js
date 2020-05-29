import React, { Component } from 'react'
import {Link} from 'react-router-dom'
import Navbar from './Navbar'
import Footer from './Footer'
import Appbar from './Appbar'
import API from '../ServiceApi/Index'
import { Helmet } from 'react-helmet'
import { NotificationManager } from 'react-notifications'
import {Container, Form, Row, Col, Button, Card} from 'react-bootstrap'

const TITLE = ' Daftar - PMB Universitas Amikom Purwokerto'
class Register extends Component {
    constructor(props){
        super(props)
        this.state = {
            nama:"",
            alamat:"",
            nohp:"",
            email:"",
            password:"",
            foto:"user.jpg",
            err:""
        }
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
                <div className="container my-3">
                    
                    <div className="col-md-6 offset-md-3">
                        <div className="card">
                            <div className="card card-default">
                                <div className="card-body">
                                    <h3 className="text-center">Daftar Akun</h3>
                                    <hr/>
                                    <Form onSubmit={this.handlerSubmit} >
                                        <Form.Group>
                                            <Form.Label>MASUKAN EMAIL</Form.Label>
                                            <Form.Control type="text" placeholder="Email" name="email" className="form-control" onChange={this.handlerChange} />
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>MASUKAN USERNAME</Form.Label>
                                            <Form.Control type="text" placeholder="Username" name="username" className="form-control" onChange={this.handlerChange} />
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>MASUKAN PASSWORD</Form.Label>
                                            <Form.Control type="password" placeholder="Password" name="password" className="form-control" onChange={this.handlerChange} />
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>MASUKAN NAMA LENGKAP</Form.Label>
                                            <Form.Control type="text" name="nama" placeholder="Nama Lengkap" className="form-control" onChange={this.handlerChange} />
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>MASUKAN TELP/NO.HP</Form.Label>
                                            <Form.Control type="text" placeholder="Telp/No.HP" name="nohp" className="form-control" onChange={this.handlerChange} />
                                        </Form.Group>
                                        
                                        
                                        <Form.Control type="submit" className="btn btn-primary btn-block" value="Daftar" />
                                    </Form>
                                    {
                                        this.state.err
                                    }
                                    <br/>
                                    <Link to="/login">LOGIN NOW</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Footer />
                <Appbar />
            </div>
        )
    }
}


export default Register