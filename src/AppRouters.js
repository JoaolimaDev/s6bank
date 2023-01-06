import React  from "react";
import Cookies from 'js-cookie';

import {
  BrowserRouter as Router,
  Route,
  Routes,
  Navigate
} from "react-router-dom";

import LoginPage from './pages/LoginPages';
import HomePage from './homepage';
import ClientPage from "./pages/ClientPages";
import TvPage from "./pages/TvPages";



const AppRoutes = () => {
  const Private = ({children}) => {
    

 

    if (!Cookies.get('auth')) {
      return <Navigate to="/login" />;
    }

    return children;
  };

  return(
    <Router>
      
      
      <Routes>
        <Route exact path="/login"
        element={<LoginPage/>}/>
        <Route exact 
        path="/" 
        element={
        <Private>
          <HomePage/>
        </Private>}/>
        <Route exact path="/client" element={<ClientPage/>}/>
        <Route exact path="/tv" element={<TvPage/>}/>
      </Routes>
      
    </Router>
  )
}

export default AppRoutes;