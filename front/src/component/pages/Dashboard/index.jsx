import React from 'react'
import DashBoard from '../../DashBoard'
import styles from './style.module.css'

export default function DashBoardPage() {
  return (
    <div className={styles.container}>
      <DashBoard data="40/mb"/>
      <DashBoard data="40/mb"/>
      <DashBoard data="40/mb"/>
      <DashBoard data="40/mb"/>
    </div>
  )
}
