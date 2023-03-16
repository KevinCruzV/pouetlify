import React from 'react'
import styles from './style.module.css'

export default function ChooseArchi() {
return (
<form method="post" enctype="multipart/form-data" className={styles.container} name="choice">
   
        <input type="text" placeholder='Name of your web site' />
        <div>
        <label for="archi"> Choose a Architecture:</label>
        <select name="archi" id="archi">
            <option value="ftp">ftp</option>
            <option value="mysql">mysql</option>
        </select>
        </div>
    <input type="submit" value="Submit" />

</form>
)
}