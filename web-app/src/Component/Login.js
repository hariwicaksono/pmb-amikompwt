import React, { Component } from 'react'
import Navbar from './Navbar'
import Footer from './Footer'
import Appbar from './Appbar'
import {Redirect,Link} from 'react-router-dom'
import API from '../ServiceApi/Index'
import { Helmet } from 'react-helmet'
import Parser from 'html-react-parser'
import { NotificationManager } from 'react-notifications';

const TITLE = ' Masuk - PMB Universitas Amikom Purwokerto'

class Login extends Component {
    constructor(props) {
        super(props)
        this.state = {
            username: "",
            password: "",
            level: "",
            isLogin:false,
            idLogin:""
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
            } else if (res.id === "2" ) {
                sessionStorage.setItem('isAdmin',JSON.stringify(res.data))
                this.setState({
                    isLogin:true,
                    idLogin:"2"
                })
                NotificationManager.success('Berhasil masuk sistem');
            } else {
                NotificationManager.warning('Login gagal, periksa username dan password anda');
            }
        })
    }

    

    render() {
       

        if(this.state.isLogin){
            if (this.state.idLogin === "1") {
                return( <Redirect to="/user" /> )
            } else {
                return(<Redirect to="admin" />)
            }
        }

        return (
            <div>
                <Helmet>
                <title>{ TITLE }</title>
                </Helmet>
                <Navbar />
                <div className="container my-5">
                    
                    <div className="col-md-4 offset-md-4">

                        <div className="card" style={{backgroundColor:''}}>
                        <div className="card card-default">
                            <div className="card-body">
                            <h4 className="mb-3">Masuk</h4>
                                <form onSubmit={this.handlerSubmit}>
                                    <div className="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" placeholder="Username" className="form-control" onChange={this.handlerChange} />
                                    </div>
                                    <div className="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Password" className="form-control" onChange={this.handlerChange} />
                                    </div>
                                    <div className="form-group">
                                    <select name="level" className="form-control" onChange={this.handlerChange} >
                                            <option>Pilih</option>
                                            <option>USER</option>
                                            <option>ADMIN</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="Masuk" className="btn btn-primary btn-block" onSubmit={this.handlerSubmit} />
                                </form>                              
                                <hr/>
                                Belum punya akun PMB? <Link to={'/register'}>Daftar Akun</Link>
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

export default Login