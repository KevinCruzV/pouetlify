import './App.css';
import {Routes, Route} from 'react-router-dom'
import Home from './component/pages/Home';
import DashBoardPage from './component/pages/Dashboard';
import Ftp from './component/pages/Ftp';
import React from "react";



function App() {
  return (
    <div className="App">
      <Routes>
        <Route path='/' element={<Home/>}/>
        <Route path='/dashboard' element={<DashBoardPage/>}/>
        <Route path='/ftp' element={<Ftp/>}/>
      </Routes>
    </div>
  );
}

export default App;
