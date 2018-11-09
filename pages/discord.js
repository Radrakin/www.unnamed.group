import React from 'react'
import Router from 'next/router'

export default class extends React.Component {
  static async getInitialProps({ res }) {
    if (res) {
      res.writeHead(302, {
        Location: 'http://armapmc.com/discord'
      })
      res.end()
    } else {
      Router.push('http://armapmc.com/discord')
    }
    return {}
  }
}
