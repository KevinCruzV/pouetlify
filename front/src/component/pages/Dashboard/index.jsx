import React, { useState, useEffect } from 'react';
import axios from 'axios';
import DashBoard from '../../DashBoard'
import styles from './style.module.css'
import {useNavigate} from "react-router-dom";

export default function DashBoardPage() {
  const [Db, setDb] = useState([]);
  const [Disque, setDisque] = useState([]);
  const [DUtil, setDUtil] = useState([]);
  const [file, setFile] = useState(null);
  const [fileName, setFileName] = useState(null);
  const navigate = useNavigate();

  const handleNavigate = () => {
    navigate('/ftp');
};

  const handleFileChange = (event) => {
    setFile(event.target.files[0]);
    setFileName(event.target.files[0].name);
  };

  const handleFileUpload = () => {
    const formData = new FormData();
    formData.append('file', file);

    axios.post('/api/backup/download', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
      .then(response => {
        const downloadUrl = response.data.downloadUrl;
        const link = document.createElement('a');
        link.href = downloadUrl;
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      })
      .catch(error => {
        console.error(error);
      });
  };

  useEffect(() => {
    axios.get('/database')
      .then(response => {
        setDb(response.data.size);
        setDisque(response.data.disque);
        setDUtil(response.data.dutil);

      })
      .catch(error => {
        console.error(error);
      });
  }, []);
  
  return (
    <div className={styles.container}>
      <DashBoard data={Db}/>
      <DashBoard data={Disque}/>
      <DashBoard data={DUtil}/>
      <div>
      <h1>Téléchargement de fichiers backup</h1>
      <input type="file" onChange={handleFileChange} />
      <button onClick={handleFileUpload}>Télécharger</button>
    </div>
    <button className="button-home" onClick={handleNavigate}>FTP</button>
    </div>
  )
}
