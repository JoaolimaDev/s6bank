import React, { useState} from "react";
import api from "../../Api/Api";
import {Navigate} from "react-router-dom";


const LoginPage = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [Auth, seAuth] = useState(false);

  const handleSubmit = (e) => {

  

    e.preventDefault();

    const parse = JSON.stringify({user: email, senha: password});

    const options = {
      headers: {
      'Content-Type': 'application/json'
      }
  
    }

    api.post("/login/", parse, options)
    .then(res => {


      var token = res['data'];

      document.cookie = "auth=" + token.Session_id; 

       seAuth(true);
  
      
    }).catch(err => { 
     
      alert("Erro contate a rquipe técnica!")
      
    })
 
  };

  return (
    
    <div id="login">

      {Auth ? <Navigate to="/" /> : null}

      <h1 className="title">Login S6-Bank </h1>
      <p>Voçê precisa logar!</p>
      <form className="form" onSubmit={handleSubmit}>
        <div className="field">
          <label htmlFor="email">Email</label>
          <input
          type="email" 
          name="email" 
          id="email" 
          value={email} 
          onChange={(e) => setEmail(e.target.value)} />
        </div>
        <div className="field">
          <label htmlFor="password">Senha</label>
          <input
           type="password"
           name="password"
           id="password"
           value={password} 
           onChange={(e) => setPassword(e.target.value)} />
        </div>
        <div className="actions">
          <button type="submit">Entrar</button>
        </div>
      </form>
    </div>
      
  );
};
export default LoginPage;