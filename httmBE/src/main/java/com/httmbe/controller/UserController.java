package com.httmbe.controller;

import com.httmbe.DTO.request.LoginRequest;
import com.httmbe.DTO.response.DetailModelDTO;
import com.httmbe.model.*;
import com.httmbe.repository.*;
import lombok.SneakyThrows;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.http.ResponseEntity;
import org.springframework.util.FileCopyUtils;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;
import org.yaml.snakeyaml.Yaml;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.*;
import java.nio.file.*;
import java.text.SimpleDateFormat;
import java.time.LocalDateTime;
import java.util.*;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

@RestController
public class UserController {
    @Autowired
    private UserRepository userRepository;

    @Autowired
    private SampleRepository sampleRepository;

    @Autowired
    private trainedModelRepository trainedModelRepository;

    @Autowired
    private SampleTrainedRepository sampleTrainedRepository;

    @Autowired
    private ModelRepository modelRepository;

    @PostMapping("/login")
    public String login(@RequestBody LoginRequest request) {
        Optional<User> user = userRepository.login(request.getUsername(), request.getPassword());
        if (user.isPresent()) {
            return "{\"results\": true}";
        } else {
            return "{\"results\": \"failed\"}";
        }
    }

    @PostMapping("train")
    public String train(@RequestParam("fileInput") MultipartFile file) {
        System.out.println(file.getOriginalFilename());
        try {
            if (file != null && !file.isEmpty()) {
                String destinationPath = "C:/Users/Asus/Downloads/Document/HTTM/code/TrainYolo2419/data_set/train/images/";
                String fileName = file.getOriginalFilename();
                Path filePath = Paths.get(destinationPath, fileName);
                Files.write(filePath, file.getBytes());

                Sample sample = new Sample();
                sample.setName(fileName);
                sample.setPath(String.valueOf(filePath));
                sample.setModelID(1);
                sampleRepository.save(sample);
                return "File uploaded successfully";
            } else {
                return "No file uploaded";
            }
        } catch (IOException e) {
            e.printStackTrace();
            return "Error uploading file";
        }
    }

    @PutMapping("/{id}")
    public String UpdateSample(@PathVariable Long id, @RequestParam("fileInput") MultipartFile file) {
        try {
            Optional<Sample> optionalSample = sampleRepository.findById(id);
            Sample existingSample = optionalSample.get();
            deleteImage(existingSample.getPath());

            String destinationPath = "C:/Users/Asus/Downloads/Document/HTTM/code/TrainYolo2419/data_set/train/images/";
            String fileName = file.getOriginalFilename();
            Path filePath = Paths.get(destinationPath, fileName);
            Files.write(filePath, file.getBytes());

            existingSample.setName(fileName);
            existingSample.setPath(String.valueOf(filePath));

            sampleRepository.save(existingSample);
            return "{\"results\": true}";
        } catch (IOException e) {
            e.printStackTrace();
            return "{\"results\": \"failed\"}";
        }
    }

    private void deleteImage(String path) {
        try {
            Path imagePath = Paths.get(path);
            Files.deleteIfExists(imagePath);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    @GetMapping("")
    public Page<Sample> sampleList(@RequestParam int page,
                                   @RequestParam int size) {
        Pageable pageableWithSort = PageRequest.of(page, size);
        return sampleRepository.findAllSamples(pageableWithSort);
    }

    @DeleteMapping("/{id}")
    public String deleteSample(@PathVariable Long id) {
        try {
            sampleRepository.deleteById(id);
            return "{\"results\": true}";
        } catch (Exception e) {
            return "{\"results\": \"failed\"}";
        }
    }

    @SneakyThrows
    @GetMapping("/retrain/{selectedId}/{weight}")
    public String retrainModel(@PathVariable String selectedId, @PathVariable String weight) {
        //Lấy id các mẫu
        System.out.println(selectedId);
        String[] idsArray = selectedId.split(",");
        Map<String, String> idToPathsMap = new HashMap<>();

        for (String id : idsArray) {
            //tìm path dựa trên id mẫu
            Optional<Sample> sample = sampleRepository.findById(Long.valueOf(id));
            Sample sample1 = sample.get();
            String pathSample = sample1.getPath();
            String pathLabel = sample1.getPathLabel();
            idToPathsMap.put(id, "pathSample:" + pathSample + ",pathLabel:" + pathLabel);
        }

        // Lấy ngày giờ hiện tại
        Date currentDate = new Date();
        SimpleDateFormat dateFormat = new SimpleDateFormat("ddMMyyHHmm");
        String formattedDate = dateFormat.format(currentDate);

        //tạo folder data_set
        String targetDirectory = "C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\data_set";
        String joinedId = String.join("", idsArray);
        String newDirectionName = "train" + joinedId + formattedDate;

        String newDirectoryPath = String.valueOf(Paths.get(targetDirectory, newDirectionName));
        //tạo folder images, labels
        Files.createDirectories(Paths.get(newDirectoryPath));
        String imagesDirectoryPath = Paths.get(newDirectoryPath, "images").toString();
        String labelsDirectoryPath = Paths.get(newDirectoryPath, "labels").toString();
        Files.createDirectories(Paths.get(imagesDirectoryPath));
        Files.createDirectories(Paths.get(labelsDirectoryPath));

        //Sao chép mẫu vào thư mục để train
        for (Map.Entry<String, String> entry : idToPathsMap.entrySet()) {
            String[] pathArray = entry.getValue().split(",");
            System.out.println("Sao chép mẫu: " + pathArray[0]);
            System.out.println("Sao chép nhãn: " +pathArray[1]);
            String pathSample = pathArray[0].substring(11, pathArray[0].length());
            String pathLabel = pathArray[1].substring(10, pathArray[1].length());

            Path pathSampleSource = Paths.get(pathSample);
            Path pathSampletarget = Paths.get(String.valueOf(Paths.get(imagesDirectoryPath)), pathSample.substring(79));

            Path pathLabelSource = Paths.get(pathLabel);
            Path pathLabeltarget = Paths.get(String.valueOf(Paths.get(labelsDirectoryPath)), pathLabel.substring(78));

            Files.copy(pathSampleSource, pathSampletarget);
            Files.copy(pathLabelSource, pathLabeltarget);
        }

        //sửa file mydataset.yaml
        Yaml yaml = new Yaml();
        InputStream inputStream = new FileInputStream("C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\yolov7\\data\\mydataset.yaml");
        Map<String, Object> yamlData = yaml.load(inputStream);
        yamlData.put("train", newDirectoryPath);

        Writer writer = new FileWriter("C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\yolov7\\data\\mydataset.yaml");
        yaml.dump(yamlData, writer);

//        retrain
        String yolov7Path = "C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\yolov7";
        List<String> command = new ArrayList<>(Arrays.asList(
                "python", "train.py",
                "--batch", "8",
                "--cfg", "cfg/training/yolov7.yaml",
                "--epochs", "1",
                "--data", "data/mydataset.yaml",
                "--weights"
        ));
        command.add("runs/train/" + weight + "/weights/best.pt");

        ProcessBuilder processBuilder = new ProcessBuilder(command);
        // Đặt thư mục làm việc của tiến trình
        processBuilder.directory(new File(yolov7Path));
        // Kết hợp stdout và stderr để có thể đọc cả hai đầu ra
        processBuilder.redirectErrorStream(true);
        // Bắt đầu tiến trình
        Process process = processBuilder.start();

        // Đọc đầu ra từ InputStream của tiến trình và in ra màn hình
        InputStream inputStream1 = process.getInputStream();
        BufferedReader reader = new BufferedReader(new InputStreamReader(inputStream1));

        String line;
        while ((line = reader.readLine()) != null) {
            System.out.println(line);
        }

        // Chờ quá trình kết thúc
        int exitCode = process.waitFor();
        System.out.println("Tiến trình đã kết thúc với mã thoát: " + exitCode);

//         Check nếu tiến trình kết thúc thành công
        if(exitCode == 0){
            //Lưu giá trị đánh giá thuật toán
            Path trainDirectoryPath = Paths.get("C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\yolov7\\runs\\train");
            try (DirectoryStream<Path> directoryStream = Files.newDirectoryStream(trainDirectoryPath)) {
                // Lưu danh sách thư mục vào một List
                List<Path> subdirectories = new ArrayList<>();
                for (Path subdirectory : directoryStream) {
                    if (Files.isDirectory(subdirectory)) {
                        subdirectories.add(subdirectory);
                    }
                }
                // Sắp xếp danh sách thư mục theo thời gian giảm dần
                Collections.sort(subdirectories, Comparator.comparingLong(p -> -p.toFile().lastModified()));
                // Duyệt qua danh sách thư mục
                for (Path subdirectory : subdirectories) {
                    // Kiểm tra xem thư mục có chứa file results.txt hay không
                    Path resultsFilePath = subdirectory.resolve("results.txt");
                    if (Files.exists(resultsFilePath)) {
                        // Nếu có, thì đọc và xử lý dữ liệu từ file này
                        String nameModel = String.valueOf(subdirectory).substring(75); // lấy ra tên cho model
                        BufferedReader reader1 = Files.newBufferedReader(resultsFilePath);
                        double boxSum = 0;
                        double objSum = 0;
                        double clsSum = 0;
                        double totalSum = 0;
                        int lineCount = 0;

                        // Duyệt qua từng dòng của file
                        String line1;
                        while ((line1 = reader1.readLine()) != null) {
                            String[] values = line1.trim().split("\\s+");
                            if (values.length >= 15) {
                                double boxValue = Double.parseDouble(values[2]);
                                double objValue = Double.parseDouble(values[3]);
                                double clsValue = Double.parseDouble(values[4]);
                                double totalValue = Double.parseDouble(values[5]);

                                boxSum += boxValue;
                                objSum += objValue;
                                clsSum += clsValue;
                                totalSum += totalValue;
                                lineCount++;
                            }
                        }
                        if (lineCount > 0) {
                            double box_avg = boxSum / lineCount;
                            double obj_avg = objSum / lineCount;
                            double cls_avg = clsSum / lineCount;
                            double total_avg = totalSum / lineCount;

                            System.out.println("box_avg = " + box_avg);
                            System.out.println("obj_avg = " + obj_avg);
                            System.out.println("cls_avg = " + cls_avg);
                            System.out.println("total_avg = " + total_avg);

                            //Lưu vào db
                            //Luu data vao db model
                            Model model = new Model();
                            model.setName(nameModel);
                            model.setPath(String.valueOf(subdirectory));
                            modelRepository.save(model);

                            //Luu vao bang train
                            trainedModel trainedModel = new trainedModel();
                            int modelID = modelRepository.findMaxID();
                            trainedModel.setBox(box_avg);
                            trainedModel.setCls(cls_avg);
                            trainedModel.setObj(obj_avg);
                            trainedModel.setTotal(obj_avg);
                            trainedModel.setEpoch(1);
                            trainedModel.setModelID(modelID);
                            trainedModelRepository.save(trainedModel);

                            //Luu data vao sample
                            for (String id : idsArray) {
                                Optional<Sample> sampleTemp = sampleRepository.findById(Long.valueOf(id));
                                Sample sample1 = sampleTemp.get();
                                Sample sample = new Sample();

                                sample.setName(sample1.getName());
                                sample.setPathLabel(sample1.getPathLabel());
                                sample.setPath(sample1.getPath());
                                sample.setModelID(modelID);
                                sampleRepository.save(sample);
                            }

                            //Luu data vao bang trung gian sample va train
                            int trainedID = trainedModelRepository.findMaxID();
                            List<Sample> sampleList = sampleRepository.findBymodelID((long) modelID);
                            for (Sample temp : sampleList){
                                SampleTrained sampleTrained = new SampleTrained();
                                sampleTrained.setSampleID((int) temp.getId());
                                sampleTrained.setTrainedID(trainedID);
                                sampleTrainedRepository.save(sampleTrained);
                            }
                            System.out.println("Đã lưu vào Database");
                        } else {
                            System.out.println("Không có dữ liệu để tính toán.");
                        }
                        break;
                    }
                }
            } catch (IOException e) {
                System.out.println("Không tìm thấy file results.txt trong bất kỳ thư mục nào.");
            }

            return "{\"results\": true}";
        }
        return "{\"results\": \"failed\"}";
    }

    @SneakyThrows
    @GetMapping("/listweight")
    public ResponseEntity<List<String>> listWeights() {
        String trainDirectoryPath = "C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\yolov7\\runs\\train";
        List<String> subdirectories;
        List<String> results = new ArrayList<>();
        try {
            subdirectories = Files.list(Paths.get(trainDirectoryPath))
                    .filter(Files::isDirectory)
                    .map(Path::getFileName)
                    .map(Path::toString)
                    .collect(Collectors.toList());

            for (String subdirectory : subdirectories) {
                Path weightsDirectory = Paths.get(trainDirectoryPath, subdirectory, "weights");
                if (containsBestPt(weightsDirectory)) {
                    results.add(subdirectory);
                    System.out.println("Thư mục có chứa best.pt: " + subdirectory);
                }
            }
            // Trả về danh sách subdirectories dưới dạng JSON
            return ResponseEntity.ok(results);
        } catch (IOException e) {
            e.printStackTrace();
            return ResponseEntity.status(500).build();
        }
    }

    private boolean containsBestPt(Path directory) throws IOException {
        try (DirectoryStream<Path> stream = Files.newDirectoryStream(directory, "best.pt")) {
            return stream.iterator().hasNext();
        }
    }

    @GetMapping("/renameFilesInFolder")
    @ResponseBody
    public String renameFilesInFolder() {
        String folderPath = "C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\data_set\\test\\images";
        File folder = new File(folderPath);
        File[] files = folder.listFiles();
        if (files != null) {
            for (File file : files) {
                if (file.isFile()) {
                    String newName = file.getName().replace("(", "").replace(")", "").replace(" ", "");
                    // Đường dẫn mới của tệp
                    String newPath = folderPath + File.separator + newName;
//                    // Thực hiện đổi tên
                    boolean success = file.renameTo(new File(newPath));
//
//                    // Kiểm tra xem đổi tên có thành công không
                    if (success) {
                        System.out.println("Đã đổi tên tệp: " + file.getName() + " thành " + newName);
                    } else {
                        System.out.println("Không thể đổi tên tệp: " + file.getName());
                    }
                }
            }
            return "Đã đổi tên các tệp trong thư mục.";
        } else {
            return "Không có tệp trong thư mục.";
        }
    }

    @GetMapping("/listModel")
    public Page<Model> listModel(@RequestParam int page,
                                 @RequestParam int size) throws IOException {
        Pageable pageableWithSort = PageRequest.of(page, size);
        return modelRepository.findAll(pageableWithSort);
    }

    @GetMapping("/detailModel/{id}")
    public DetailModelDTO detailModelDTO(@PathVariable Long id) {
        DetailModelDTO detailModelDTO = new DetailModelDTO();

        // Lấy thông tin Model
        Model model = modelRepository.findById(id).orElse(null);
        detailModelDTO.setModel(model);
        // Lấy danh sách Sample của Model
        List<Sample> samples = sampleRepository.findBymodelID(id);
        detailModelDTO.setSamples(samples);

        // Lấy danh sách TrainedModel từ SampleTrained
//        for (Sample sample : samples) {
//            List<SampleTrained> sampleTrainedList = sampleTrainedRepository.findBysampleID(sample.getId());
//            for (SampleTrained sampleTrained : sampleTrainedList) {
//                trainedModel trainedModel = trainedModelRepository.findById((long) sampleTrained.getTrainedID()).orElse(null);
//                detailModelDTO.addTrainedModel(trainedModel);
//            }
//        }
        List<trainedModel> trainedModelList = trainedModelRepository.findByModelID(id);
        detailModelDTO.setTrainedModels(trainedModelList);
        return detailModelDTO;
    }

    @DeleteMapping("/model/{id}")
    public String deleteModel(@PathVariable Long id) {
        try {
            Optional<Model> optionalModel = modelRepository.findById(id);
            Model model = optionalModel.get();
            deleteImage(model.getPath());
            modelRepository.deleteById(id);
            return "{\"results\": true}";
        } catch (Exception e) {
            return "{\"results\": \"failed\"}";
        }
    }

    @PutMapping("/updateModel/{id}/{name}")
    public String UpdateModel(@PathVariable Long id, @PathVariable String name) {
        Optional<Model> optionalModel = modelRepository.findById(id);
        Model model = optionalModel.get();
        String sourceFolderPath = model.getPath();
        String destinationFolderPath = "C:\\Users\\Asus\\Downloads\\Document\\HTTM\\code\\TrainYolo2419\\yolov7\\runs\\train";
        try {
            Path sourcePath = Paths.get(sourceFolderPath);
            Path destinationPath = Paths.get(destinationFolderPath, name);
            Files.walk(sourcePath)
                    .forEach(source -> {
                        try {
                            Path destination = destinationPath.resolve(sourcePath.relativize(source));
                            Files.copy(source, destination, StandardCopyOption.REPLACE_EXISTING);
                        } catch (IOException e) {
                            e.printStackTrace();
                        }
                    });
            Files.walk(sourcePath)
                    .sorted(java.util.Comparator.reverseOrder())
                    .map(Path::toFile)
                    .forEach(File::delete);

            String newPathModedl = String.valueOf(destinationPath);
            model.setPath(newPathModedl);
            model.setName(name);
            modelRepository.save(model);
            return "{\"results\": true}";
        } catch (IOException e) {
            throw new RuntimeException(e);
        }
    }
}
