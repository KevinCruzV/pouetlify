import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import styles from './style.module.css'

export default function ChooseArchi() {

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
        <form onSubmit={handleSubmit} className={styles.container}>
          <label>
            Option :
            <select value={selectedOption} onChange={handleOptionChange}>
              <option value="">-- Choisissez une option --</option>
              <option value="ftp">FTP</option>
              <option value="mysql">MySQL</option>
            </select>
          </label>
          <button type="submit">Envoyer</button>
        </form>
      );

}