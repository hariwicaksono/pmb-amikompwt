import React, { Component } from 'react'
import Navbar from './Navbar'
import Footer from './Footer'
import {Redirect,Link} from 'react-router-dom'
import API from '../ServiceApi/Index'
import { Helmet } from 'react-helmet'
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
            idLogin:"",
            gagalLogin : ""
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
                NotificationManager.success('Berhasil masuk kedalam sistem', 'Login!');
            } else if (res.id === "2" ) {
                sessionStorage.setItem('isAdmin',JSON.stringify(res.data))
                this.setState({
                    isLogin:true,
                    idLogin:"2"
                })
                NotificationManager.success('Berhasil masuk kedalam sistem', 'Login!');

            } else {
                NotificationManager.warning('Login gagal, periksa username dan password anda', 'Perhatian!');
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
                <div className="container">
                    
                    <div className="col-md-4 offset-4">
                        <h1>Login</h1>
                        <br />
                        <div className="card">
                            <div className="card-body">
                                <form onSubmit={this.handlerSubmit}>
                                    <div className="form-group">
                                        <label>MASUKAN EMAIL</label>
                                        <input type="text" name="username" className="form-control" onChange={this.handlerChange} />
                                    </div>
                                    <div className="form-group">
                                        <label>MASUKAN PASSWORD</label>
                                        <input type="password" name="password" className="form-control" onChange={this.handlerChange} />
                                    </div>
                                    <div className="form-group">
                                        <select name="level" className="form-control" onChange={this.handlerChange}>
                                            <option>--PILIH LEVEL--</option>
                                            <option>USER</option>
                                            <option>ADMIN</option>
                                        </select>
                                    </div>
                                    <input type="submit" value="LOGIN" className="btn btn-info" onSubmit={this.handlerSubmit} />
                                </form>
                        
                                <hr/>
                                <Link to={'/register'}>DAFTAR AKUN</Link>
                            </div>
                        </div>
                    </div>
                </div>
                <Footer />
            </div>
        )
    }
}

export default Login