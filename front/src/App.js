import React from "react";
import { Routes, Route } from "react-router-dom";
import { BrowserRouter as Router } from "react-router-dom";
import Navbar from "./components/Navbar/Navbar";
import Ads from "./components/Ads/Ads";
import AdCreate from "./components/AdCreate/AdCreate";
import Card from "./components/Card/Card";

export default function App() {
  return (
    <>
      <Router>
        <Navbar/>
        <Routes>
          <Route exact path="/" element={<Card/>} />
          <Route exact path="/create" element={<AdCreate/>} />
          <Route exact path="/ads" element={<Ads/>} />
        </Routes>
      </Router>
    </>
  );
}
