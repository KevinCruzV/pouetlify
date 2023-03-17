import React, {useState} from 'react'
import DashBoard from '../../DashBoard'
import styles from './style.module.css'
import {useNavigate} from "react-router-dom";
import axios from "axios";

export default function DashBoardPage() {
    const [selectedOption, setSelectedOption] = useState('');
    const navigate = useNavigate();

    const handleOptionChange = (event) => {
        setSelectedOption(event.target.value);
    }

    const handleSubmit = (event) => {
        event.preventDefault();

        const data = {
            option: selectedOption
        };

        axios.post('/api/generator', data)
            .then(response => {
                console.log(response);
                navigate('/dashboard-page');
            })
            .catch(error => {
                console.log(error);
            });
    }
  
  return (
    <div className={styles.container}>
      <DashBoard data="40/mb"/>
      <DashBoard data="40/mb"/>
      <DashBoard data="40/mb"/>
      <DashBoard data="40/mb"/>
    </div>
  )
}
