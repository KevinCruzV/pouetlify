import React, { useState } from 'react';
import styles from './style.module.css'
import iconeFolder from '../../icons8-dossier-256.png'
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

export default function Ftp() {
    
    const [selectedFile, setSelectedFile] = useState(null);
    const [dragging, setDragging] = useState(false);
    const navigate = useNavigate();

    const handleSubmit = (event) => {
        event.preventDefault();

        const formData = new FormData();

        formData.append('file', selectedFile);

        axios.post("/file", formData, {
            headers: {
            'Content-Type': 'multipart/form-data'
            }
        }).then(response => {
            console.log(response);
        }).catch(error => {
            console.log(error);
        });
    }
    const handleFileInputChange = (event) => {
        setSelectedFile(event.target.files[0]);
      }
  
    const handleDragOver = (event) => {
      event.preventDefault();
      setDragging(true);
    }
  
    const handleDragLeave = (event) => {
      event.preventDefault();
      setDragging(false);
    }
  
    const handleDrop = (event) => {
      event.preventDefault();
      setDragging(false);
      const file = event.dataTransfer.files[0];
      setSelectedFile(file);
    }

    const handleNavigate = () => {
        navigate('/dashboard-page');
    };
    
    return (
        <>
        <form onSubmit={handleSubmit} encType="multipart/form-data" className={`styles.container ${dragging ? "dragging" : ""}`}
            onDragOver={handleDragOver}
            onDragLeave={handleDragLeave}
            onDrop={handleDrop}>
            <label for="file" className={styles.iconFolder}>
                <img src={iconeFolder} alt="icon Folder" />
            </label>
            <input type="file" name="file" directory="" webkitdirectory="" id="file" className={styles.selectFolder} onChange={handleFileInputChange} />
            <p>ou faites glisser un fichier ici</p>
            <button type="submit">Envoyer</button>
        </form>
        <button className="button-home" onClick={handleNavigate}>Accueil</button>
        </>
    );
    
}