import React, { Component } from 'react'
import {Link} from 'react-router-dom'
import {CardDeck, Card} from 'react-bootstrap'
import { CursorFill, Building, FileEarmarkText, Grid, Folder, DisplayFill } from 'react-bootstrap-icons'
 
class NavButton extends Component{
    render(){
       
        return(  
            <div className="sticky-bottom sticky-top" style={{backgroundColor: "#482373",paddingRight:"15px"}}>
                <CardDeck className="mb-2">
                   
                        <Card text="light" as={Link} to='/about' className="text-center mr-0 link-unstyled" style={{backgroundColor:'#753478'}}>
                        <Card.Body>
                        <Card.Title><Grid size={40}/></Card.Title>
                        <Card.Text>
                            Petunjuk
                        </Card.Text>
                        </Card.Body>
                       
                    </Card>
                  
                  
                    <Card text="light" as={Link} to='/about' className="text-center mr-0 link-unstyled" style={{backgroundColor:'#753478'}}>
                        <Card.Body>
                        <Card.Title><CursorFill size={40}/></Card.Title>
                        <Card.Text>
                            Jalur Penerimaan
                        </Card.Text>
                        </Card.Body>
                       
                    </Card>
                    
                    </CardDeck>
                    
                    <CardDeck className="mb-2">
                   
                        <Card text="light" as={Link} to='/about' className="text-center mr-0 link-unstyled" style={{backgroundColor:'#753478'}}>
                        <Card.Body>
                        <Card.Title><Building size={40}/></Card.Title>
                        <Card.Text>
                           Fakultas &amp; Program Studi
                        </Card.Text>
                        </Card.Body>
                       
                    </Card>
                  
                  
                    <Card text="light" as={Link} to='/about' className="text-center mr-0 link-unstyled" style={{backgroundColor:'#753478'}}>
                        <Card.Body>
                        <Card.Title><FileEarmarkText size={40}/></Card.Title>
                        <Card.Text>
                            Biaya Pendidikan
                        </Card.Text>
                        </Card.Body>
                       
                    </Card>
                    
                    </CardDeck>
                    
                    <CardDeck className="mb-2">
                   
                        <Card text="light" as={Link} to='/about' className="text-center mr-0 link-unstyled" style={{backgroundColor:'#753478'}}>
                        <Card.Body>
                        <Card.Title><Folder size={40}/></Card.Title>
                        <Card.Text>
                            Beasiswa
                        </Card.Text>
                        </Card.Body>
                       
                    </Card>
                  
                  
                    <Card text="light" as={Link} to='/about' className="text-center mr-0 link-unstyled" style={{backgroundColor:'#753478'}}>
                        <Card.Body>
                        <Card.Title><DisplayFill size={40}/></Card.Title>
                        <Card.Text>
                           Fasilitas
                        </Card.Text>
                        </Card.Body>
                       
                    </Card>
                    
                    </CardDeck>
                    </div>
        )
    }
}

export default NavButton