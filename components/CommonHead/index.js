import React from 'react';
import Head from 'next/head';
import "bootstrap/dist/css/bootstrap.min.css";
import "../../static/css/custom.css";

export default class extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      title: props.title || "Unnamed Arma Group",
      subtitle: props.subtitle || undefined,
      description: props.description || "\"No Bullshit\" Arma 3 MILSIM",
      author: props.author || "Alex (@zeue)",
      logoPath: props.logoPath || "/static/img/logo.png",
    };
    this.getTitle = this.getTitle.bind(this);
  }

  getTitle() {
    if (this.state.subtitle) {
      return this.state.title + " | " + this.state.subtitle
    } else {
      return this.state.title
    }
  }

  render() {
    return (
      <Head>
        <meta charSet="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>{this.getTitle()}</title>
        <meta name="description" content={this.state.description}/>
        <meta name="author" content={this.state.author}/>
        <link rel="icon" href={this.state.logoPath}/>
      </Head>
    )
  }
}
