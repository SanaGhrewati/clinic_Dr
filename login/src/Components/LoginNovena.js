import './LoginNovena.css';
import React from 'react';
import {FaLock , FaUser} from 'react-icons/fa'
function LoginNovena() {
    return <div className="wrapper">
        <form action="">
            <h1>Login</h1>
            <div className="input-box">
                <input type="text" placeholder="Username" />
                <FaUser className="icon"/>
            </div>
            <div className="input-box">
                <input type="text" placeholder="password" />
                <FaLock className="icon"/>
            </div>
            <div className="remember-forgot">
                <label>
                    <input type="checkbox" />
                    Remamber me
                </label>
                <a href="/#">forgot password?</a>
            </div>
            <button type="submit">Login</button>
            <div className="register-link">
                <p>
                don't have an account? <a href="/#">Register</a>
                </p>
            </div>
        </form>
    </div>;
}

export default LoginNovena;