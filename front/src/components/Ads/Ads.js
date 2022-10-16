import React, { useEffect, useState } from "react";
import { makeStyles } from '@material-ui/core/styles';
import Typography from '@material-ui/core/Typography';
import Button from '@material-ui/core/Button';
import Container from '@material-ui/core/Container';
import Paper from '@material-ui/core/Paper';
import Box from '@material-ui/core/Box';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import ButtonGroup from '@material-ui/core/ButtonGroup';
import { Link } from "react-router-dom";

const useStyles = makeStyles((theme) => ({
  root: {
    flexGrow: 1,
  },
  menuButton: {
    marginRight: theme.spacing(2),
  },
  title: {
    flexGrow: 1,
    marginRight:theme.spacing(30)
  },
  container: {
    marginTop: theme.spacing(2),
    
  },
  paper: {
    padding: theme.spacing(2),
    color: theme.palette.text.secondary,
  },
}));

export default function AdList() {
  const classes = useStyles();

  const [ads, setAds] = useState([]);
  useEffect(() => {
    AdsGet()
  }, [])
  
  const AdsGet = () => {
    fetch("https://127.0.01:8001/api/annonces")
      .then(res => res.json())
      .then(
        (result) => {
          setAds(result['hydra:member'])
        }
      )
  }

  const UpdateAd = id => {
    window.location = '/update/'+id
  }

  const AdDelete = id => {
    var data = {
      'id': id
    }
    fetch('https://127.0.01:8001/api/annonces/{id}', {
      method: 'DELETE',
      headers: {
        Accept: 'application/form-data',
        'Content-Type': 'application/ld+json',
      },
      body: JSON.stringify(data),
    })
    .then(res => res.json())
    .then(
      (result) => {
        alert(result['message'])
        if (result['status'] === 'ok') {
          AdsGet();
        }
      }
    )
  }

  return (
    <div className={classes.root}>
      <Container className={classes.container} maxWidth="lg">    
        <Paper className={classes.paper}>
          <Box display="flex">
            <Box flexGrow={1}>
              <Typography component="h2" variant="h6" color="primary" gutterBottom>
                USERS
              </Typography>
            </Box>
            <Box>
              <Link to="/create">
                <Button variant="contained" color="primary">
                  CREATE
                </Button>
              </Link>
            </Box>
          </Box>
          <TableContainer component={Paper}>
          <Table className={classes.table} aria-label="simple table">
            <TableHead>
              <TableRow>
                <TableCell >ID</TableCell>
                <TableCell >Title</TableCell>
                <TableCell>Summary</TableCell>
                <TableCell>Contrat</TableCell>
                <TableCell>Wage</TableCell>

              </TableRow>
            </TableHead>
            <TableBody>
              {ads.map((ad) => (
                <TableRow key={ad.ID}>
                  <TableCell align="left">{ad.id}</TableCell>
                  <TableCell align="center">{ad.title}</TableCell>
                  <TableCell align="center">{ad.summary}</TableCell>
                  <TableCell align="right">{ad.contrat}</TableCell>
                  <TableCell align="right">{ad.wage}</TableCell>
                  <TableCell align="center">
                    <ButtonGroup color="primary" aria-label="outlined primary button group">
                      <Button onClick={() => UpdateAd(ad.id)}>Edit</Button>
                      <Button onClick={() => AdDelete(ad.id)}>Del</Button>
                    </ButtonGroup>
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>
        </Paper>
      </Container>
    </div>
    
  );
}