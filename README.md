<h1 align="center">Caption Craft</h1>


# Caption Craft - Image Caption Generator

Welcome to **Caption Craft**, a web application designed to generate descriptive captions for images using deep learning. Built with Flask and Keras, Caption Craft provides an intuitive interface for users to upload images and receive detailed, contextually accurate captions.

The application leverages a model trained on the Flickr8k dataset, combining Convolutional Neural Networks (CNNs) for image feature extraction with Recurrent Neural Networks (RNNs) for generating coherent and meaningful text descriptions. 

## Features ✨

- **Image Upload**: Users can upload images through a user-friendly web interface.
- **Caption Generation**: The app generates textual descriptions (captions) for uploaded images using a recurrent neural network (RNN) based architecture.
- **Transfer Learning**: Utilizes a pre-trained ResNet50 model for feature extraction from images.
- **Sequential Model Architecture**: Combines a Convolutional Neural Network (CNN) for image processing with a Long Short-Term Memory (LSTM) network for sequence generation.

## Dataset: Flickr8k 📷

The model is trained on the **Flickr8k dataset**, which is widely used for image captioning tasks.

### Flickr8k Dataset Overview

- **Images**: The Flickr8k dataset consists of 8,000 images, each depicting a variety of scenes including people, animals, and urban environments.
- **Captions**: Each image is paired with five different captions, providing diverse descriptions and contextual understanding. These captions are written by humans and describe the salient aspects of each image.
- **Source**: The dataset is available at [Flickr8k Dataset](https://www.kaggle.com/datasets/adityajn105/flickr8k).

### Dataset Preprocessing ⚙️

- **Image Resizing**: All images are resized to 224 × 224 pixels to match the input dimensions of the ResNet50 model.
- **Normalization**: Images are normalized by scaling pixel values to the range [0, 1].
- **Tokenization**: Captions are tokenized into words and converted to numerical sequences using a vocabulary file (`mine_vocab.npy`).
- **Padding**: Sequences are padded to a maximum length of 40 words to ensure uniform input size.

## Model Architecture 🔧

The image captioning model in Caption Craft is built by combining a Convolutional Neural Network (CNN) for image feature extraction with a Recurrent Neural Network (RNN) for generating captions. The model leverages transfer learning by using a pre-trained ResNet50 model as the feature extractor.

### Image Model (CNN) 🧠

- **Base Model**: ResNet50 (pre-trained on ImageNet).
  - **Layers Used**: All convolutional layers up to the global average pooling layer.
  - **Output**: A 2048-dimensional feature vector.
- **Dense Layer**: A fully connected layer with ReLU activation.
  - **Embedding Dimension**: 128.
  - **RepeatVector**: Repeats the image feature vector to match the length of the caption sequence.

### Language Model (RNN) 🧠

- **Embedding Layer**: Converts word indices into dense vectors of fixed size.
  - **Input Dimension**: Vocabulary size.
  - **Output Dimension**: 128.
  - **Input Length**: 40 (maximum length of the caption sequence).
- **LSTM Layers**:
  - **First LSTM Layer**: Outputs a sequence of vectors to feed into the next LSTM.
  - **Second LSTM Layer**: Outputs a final hidden state used for word prediction.
  - **Hidden Units**: 256 (first LSTM), 128 (second LSTM).
- **TimeDistributed Layer**: Applies a Dense layer to each time step in the sequence.

### Caption Generator (Decoder) 🧩

- **Concatenation**: Combines the outputs of the image model and the language model.
- **Dense Layer**: Projects the concatenated features into a higher-dimensional space.
  - **Units**: 512.
- **Softmax Activation**: Predicts the probability distribution over the vocabulary for the next word in the sequence.

### Model Compilation 🛠️

- **Loss Function**: Categorical cross-entropy, suitable for multi-class classification tasks.
- **Optimizer**: RMSprop, chosen for its ability to handle the vanishing gradient problem in RNNs.
- **Metrics**: Accuracy, to monitor the model’s performance during training.

### Training 🧑‍💻

- **Batch Size**: 64.
- **Epochs**: 20.
- **Data Augmentation**: Applied to the training images to enhance model generalization.
- **Validation Split**: 10% of the data is used for validation during training.

## Usage 🚀

### 1. Clone the repository:

   ```bash
   git clone https://github.com/Mohamed-Ismail-Dev/Caption-Craft.git
   cd Caption-Craft
   ```
### 2. Install the required dependencies:

   ```bash
   pip install -r requirements.txt
   ```

### 3. Download the pre-trained model weights and vocabulary:

  To download the pre-trained model weights and vocabulary, use the following commands:

   ### Using `wget`
    
   **Download the pre-trained model weights**
      
      wget https://github.com/Mohamed-Ismail-Dev/Caption-Craft/raw/main/mine_model_weights.h5
    
   **Download the vocabulary file**
    
      wget https://github.com/Mohamed-Ismail-Dev/Caption-Craft/raw/main/mine_vocab.npy

   ### Using `curl`
    
   **Download the pre-trained model weights**
    
    curl -O https://github.com/Mohamed-Ismail-Dev/Caption-Craft/raw/main/mine_model_weights.h5
    
   **Download the vocabulary file**
   
    curl -O https://github.com/Mohamed-Ismail-Dev/Caption-Craft/raw/main/mine_vocab.npy

### 4. Run the Flask app:

   ```bash
   python app.py
   ```

### 5. Access the app by navigating to http://localhost:5000/ in your web browser.
   
### 6. Upload an image to generate a caption using Caption Craft.

## Project Structure 🗂️

The project directory contains the following files and directories:

- **`app.py`**: The main Flask application script.
- **`mine_model_weights.h5`**: Model weights file containing the trained parameters.
- **`mine_vocab.npy`**: Vocabulary file used for mapping words to indices and vice versa.
- **`templates/`**: Contains HTML files for the web interface, including login and registration processes, and a subfolder named `Home` with CSS, images, and the homepage HTML.


## License 📝

This project is licensed under the MIT License.

## Acknowledgments 🙌

- The **Flickr8k** dataset used for training the model.
- The implementation is inspired by the ["Show and Tell: A Neural Image Caption Generator"](https://arxiv.org/abs/1411.4555) paper.
- The **ResNet50** model is sourced from Keras' applications module.


