package com.example;

import java.io.IOException;

import javafx.fxml.FXML;

public class PrimaryController {

    @FXML // significa que se van a manipular etiquetas html
    private void switchToSecondary() throws IOException {
        App.setRoot("secondary");
    }
}
