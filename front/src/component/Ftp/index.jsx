import React from 'react'
import styles from './style.module.css'
import iconeFolder from '../../icons8-dossier-256.png'

export default function Ftp() {
return (
<form method="post" className={styles.container}>
    <label for="file" className={styles.iconFolder}>
        <img src={iconeFolder} alt="icon Folder" />
    </label>
    <input type="file" name="file" directory="" webkitdirectory="" id="file" className={styles.selectFolder} />
    <p>Seclect your folder</p>
</form>
)
}