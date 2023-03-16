import React from 'react'
import Card from '../Card'
import styles from './style.module.css'

export default function DashBoard(props) {
  return (
    <div className={styles.data}>
        <Card>
            {props.data}
        </Card>
    </div>
  )
}
