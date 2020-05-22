import React from 'react';
import {BrowserRouter,Route} from 'react-router-dom'
import Home from './Component/Home';
import Ujianonline from './Component/User/Ujianonline';
import Login from './Component/Login';
import Register from './Component/Register';
import User from './Component/User/Index';
import Page from './Component/Page';
import Index from './Component/Admin/Index';
import { NotificationContainer } from 'react-notifications';

function App() {
  return (
    <BrowserRouter>
        <Route path="/" exact component={Home} />
        <Route path="/ujianonline" component={Ujianonline} />
        <Route path="/login" component={Login} />
        <Route path="/register" component={Register} />
        <Route path="/user" component={User} />
        <Route path="/page/:id" component={Page} />
        <Route path="/admin" component={Index} />
        <NotificationContainer />
 
    </BrowserRouter>
  );
}

export default App;
