import React from 'react'
import ChooseArchi from '../../ChooseArchi/Index'
import styles from './style.module.css'

export default function Home() {
  return (
    <div className={styles.containerHome}>
        <ChooseArchi/>
    </div>
  )
}
